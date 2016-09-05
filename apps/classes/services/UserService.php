<?php

AAFW::import('jp.aainc.lib.base.aafwServiceBase');
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class UserService extends aafwServiceBase {
    const STRETCH_COUNT = 5;
    const FIXED_SALT    = 'edc21dc921dcc1285d9b740b833af2c72bc0afc960b48ae5c9d00c14bda400bb';

    public function __construct() {
        $this->users     = $this->getModel('Users');
        $this->db        = new aafwDataBuilder();
        $this->condition = array('day' => date('Y-m-d'));
    }

    private function getSalt($email) {
        return $email.pack('H*', self::FIXED_SALT);
    }

    public function getEmailHash($email, $password) {
        $salt = $this->getSalt($email);
        $hash = '';
        for ($i = 0; $i < self::STRETCH_COUNT; $i ++) {
            $hash = hash('sha256', $hash.$password.$salt);
        }

        return $hash;
    }

    public function getUserByEmail($email) {
        return $this->users->findOne(array('email' => $email));
    }

    public function updateLastLogin($user) {
        $user->last_login = date('Y/m/d H:i:s');
        $this->users->save($user);
    }


    public function authenticate($email, $password) {
        $password = $this->getEmailHash($email, $password);
        $user     = $this->users->findOne(
            array(
             'email'    => $email,
             'password' => $password,
            )
        );
        return $user;
    }

    public function createUser($email, $password) {
        $user           = new User();
        $user->email    = $email;
        $user->password = $this->getEmailHash($email, $password);
        $this->users->save($user);

        return $user;
    }

    public function getAllUser() {
        return $this->users->find(array('order' => array('direction' => 'desc')));
    }

    public function getTodayTimeSheet($user) {
        $timesheets = $this->getModel('TimeSheets');
        return $timesheets->findOne(
            array(
             'user_id' => $user->id,
             'day'     => date('Y-m-d'),
            )
        );
    }

    public function isCheckedOut($user) {
        $result = $this->getTodayTimeSheet($user);
        if ($result) {
            if ($result->check_out_time != "0000-00-00 00:00:00") {
                return true;
            }
        }

        return false;
    }

    public function hasReport($user) {
        $result = $this->getTodayTimeSheet($user);

        if ($result) {
            $reports = $this->getModel('Reports');
            $report  = $reports->findOne(array('timesheet_id' => $result->id));
            if ($report) {
                return true;
            }
        }

        return false;
    }

    public function getStatus($user) {
        $status = new stdClass();
        if ($this->getTodayTimeSheet($user)) {
            $status->checked_in = true;
        }

        if ($this->isCheckedOut($user)) {
            $status->checked_out = true;
        }

        if ($this->hasReport($user)) {
            $status->has_report = true;
        }

        return $status;
    }

    public function getAllUserCheckedIn() {
        return $this->db->getAllUserInfo($this->condition);
    }

    public function getUsersCheckedInByDate($date) {
        $condition = array('day' => $date);
        return $this->db->getAllUserInfo($condition);
    }

    public function getUsersNotCheckInByDate($date) {
        $condition = array('day' => $date);
        return $this->db->getAllUserNotCheckIn($condition);
    }

    public function getAllUserNotCheckIn() {
        return $this->db->getAllUserNotCheckIn($this->condition);
    }

    public function getAllReportOfUser($user_id) {
        $timesheets = $this->getModel('TimeSheets');
        $timesheet  = $timesheets->find(array('conditions' => array('user_id' => $user_id)));

        $arr = array();
        foreach ($timesheet as $t) {
            $arr[] = $t->id;
        }

        $reports = $this->getModel('Reports');
        $report  = $reports->find(array('conditions' => array('timesheet_id' => $arr)));

        return $report;
    }

    public function changePassword($user, $newPassword) {
        $user           = $this->getUserByEmail($user->email);
        $newPassword    = $this->getEmailHash($user->email, $newPassword);
        $user->password = $newPassword;
        $this->users->save($user);

        return $user;
    }

    public function getUserById($id) {
        return $this->users->findOne(array('id' => $id));
    }

    public function deleteUser($id) {
        $user = $this->getUserById($id);
        try {
            $this->users->deletePhysical($user);
        } catch (Exception $e) {
            var_dump($e);
            exit(1);
        }
    }

    public function setAdmin($id) {
        $user          = $this->getUserById($id);
        $user->isAdmin = true;
        try {
            $this->users->save($user);
        } catch (Exception $e) {
            var_dump($e);
            exit(1);
        }
    }

    public function resetPassword($id) {
        $user        = $this->getUserById($id);
        $newPassword = '123456';
        return $this->changePassword($user, $newPassword);
    }

    public function totalCount($filter=null ) {
        return $this->users->count($filter);
    }

    public function getUsersByPage($param) {
        $db = new aafwDataBuilder();
        return $db->getUsersByPage($param);
    }

    public function getUserBySession($session) {
        if (isset($session['login_id'])) {
            return $this->users->findOne(array('id' => $session['login_id']));
        }
    }
}
