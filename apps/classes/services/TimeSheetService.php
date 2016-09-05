<?php

AAFW::import('jp.aainc.lib.base.aafwServiceBase');
AAFW::import('jp.aainc.classes.entities.TimeSheet');
AAFW::import('jp.aainc.classes.entities.User');

class TimeSheetService extends aafwServiceBase {

    public function __construct() {
        $this->timesheets = $this->getModel('TimeSheets');
    }

    public function createTimeSheet($user_id) {
        $timesheet          = new TimeSheets();
        $timesheet->user_id = $user_id;
        $timesheet->day     = date('Y-m-d');
        $this->$timesheets->save($timesheet);
        return $timesheet;
    }

    public function updateCheckOutTime($user) {
        $timesheet = $this->getTimeSheet($user);
        $timesheet->check_out_time = date('Y-m-d H:i:s');
        $timesheet->status         = 'Checked out';
        $this->$timesheets->save($timesheet);
        return $timesheet;
    }

    public function getUserBySession($session) {
        $users = $this->getModel('Users');
        if (isset($session['login_id'])) {
            return $users->findOne(array('id' => $session['login_id']));
        }
    }

    public function getTimeSheet($user) {
        return $this->$timesheets->findOne(
            array(
             'user_id' => $user->id,
             'day'     => date('Y-m-d'),
            )
        );
    }

    public function getAllTimeSheet() {
        return $this->$timesheets->find(array('order' => array('direction' => 'desc')));
    }

    public function setFlashMessage($status) {
        switch ($status) {
        case '1':
            return "Login successfully.";
                break;
        case '2':
            return "Check in successfull. Enjoy your working day.";
                break;
        case '3':
            return "You have been checked in.";
                break;
        case '4':
            return "Check out successfull.";
                break;
        case '5':
            return "You have report today.";
                break;
        default:
            break;
        }
    }
}
