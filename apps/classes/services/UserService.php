<?php
AAFW::import ( 'jp.aainc.lib.base.aafwServiceBase' );
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class UserService extends aafwServiceBase {
	const STRETCH_COUNT = 5;
	const FIXED_SALT = 'edc21dc921dcc1285d9b740b833af2c72bc0afc960b48ae5c9d00c14bda400bb';
	
	private function getSalt($email) {
		return $email . pack ( 'H*', self::FIXED_SALT );
	}
	
	public function getEmailHash($email, $password) {
		$salt = $this->getSalt ( $email );
		$hash = '';
		for($i = 0; $i < self::STRETCH_COUNT; $i ++) {
			$hash = hash ( 'sha256', $hash . $password . $salt );
		}
		return $hash;
	}
	
	public function getUserByEmail($email) {
		$users = $this->getModel ( 'Users' );
		return $users->findOne ( array (
			'email' => $email 
			) );
	}
	
	public function updateLastLogin($user) {
		$users = $this->getModel ( 'Users' );
		$user->last_login = date ( 'Y/m/d H:i:s' );
		$users->save ( $user );
	}
	

	public function authenticate($email, $password) {
		$password = $this->getEmailHash ( $email, $password );
		$users = $this->getModel ( 'Users' );
		$user = $users->findOne ( array (
			'email' => $email,
			'password' => $password 
			) );
		return $user;
	}
	
	public function createUser($email, $password) {
		$users = $this->getModel('Users');
		$user = new User();
		//$user->username = $username;
		$user->email = $email;
		//$user->profile_picture = '/img/member_avata/default.gif';
		//$user->status = 0;
		$user->password = $this->getEmailHash($email, $password);
		//$user->last_login = date('Y/m/d H:i:s');
		$users->save($user);		
		return $user;
	}

	public function getAllUser(){
		$users = $this->getModel('Users');
		return $users->find(array('order'=>array('direction'=>'desc')));
	}

	public function getTodayTimeSheet($user){
		$timesheets = $this->getModel('TimeSheets');
		return $timesheets->findOne(array(
			'user_id'=>$user->id,
			'day' => date('Y-m-d')
			));
	}

	public function isCheckedOut($user){
		$timesheets = $this->getModel('TimeSheets');
		$result = $this->getTodayTimeSheet($user);
		if($result){
			if($result->check_out_time != "0000-00-00 00:00:00")
				return true;
		}
		return false;		
	}

	public function hasReport($user){
		$timesheets = $this->getModel('TimeSheets');
		$result = $this->getTodayTimeSheet($user);

		if($result){
			$reports = $this->getModel('Reports');
			$report = $reports->findOne(array('timesheet_id' => $result->id));
			if($report) return true;
		}

		return false;
	}

	public function getAllUserCheckedIn(){
		$db = new aafwDataBuilder();
		$condition = array('day'=> date('Y-m-d'));
		return $db->getAllUserInfo($condition);
	}

	public function getUsersCheckedInByDate($date){
		$db = new aafwDataBuilder();
		$condition = array('day'=> $date);
		return $db->getAllUserInfo($condition);
	}

	public function getUsersNotCheckInByDate($date){
		$db = new aafwDataBuilder();
		$condition = array('day'=> $date);
		return $db->getAllUserNotCheckIn($condition);
	}
	
	public function getAllUserNotCheckIn(){
		$db = new aafwDataBuilder();
		$condition = array('day'=> date('Y-m-d'));
		return $db->getAllUserNotCheckIn($condition);
	}

	public function getAllRepostOfUser($user_id){
		$timesheets = $this->getModel('TimeSheets');
		$timesheet = $timesheets->find(array('conditions'=>array('user_id'=>$user_id)));
		$arr = array();
		foreach ($timesheet as $t) {
			$arr[] = $t->id;
		}

		$reports = $this->getModel('Reports');
		$report = $reports->find(array('conditions'=>array('timesheet_id'=>$arr)));

		return $report;
	}
	
	public function changePassword($user, $newPassword) {
		$users = $this->getModel('Users');
		$user = $this->getUserByEmail($user->email);
		$newPassword = $this->getEmailHash($user->email, $newPassword);
		$user->password = $newPassword;
		$users->save($user);
		return $user;
	}
	
	public function getUserById($id) {
		$users = $this->getModel ( 'Users' );
		return $users->findOne ( array (
			'id' => $id 
			) );
	}
	
	public function deleteUser($id){
		$users = $this->getModel ( 'Users' );
		$user = $this->getUserById($id);
		try {
			$users->deletePhysical($user);
		} catch (Exception $e) {
			var_dump($e); exit(1);
		}
	}

	public function setAdmin($id){
		$users = $this->getModel ( 'Users' );
		$user = $this->getUserById($id);
		$user->isAdmin = true;
		try {
			$users->save($user);
		} catch (Exception $e) {
			var_dump($e); exit(1);
		}
	}

	public function resetPassword($id){
		$user = $this->getUserById($id);
		$newPassword = '123456';
		return $this->changePassword($user, $newPassword);
	}

	public function totalCount($filter=null ) {
		$users = $this->getModel ( 'Users' );
		return $users->count($filter);
	}

	public function getUsersByPage($param){
		$db = new aafwDataBuilder();
		return $db->getUsersByPage($param);
	}

	public function getUsersListByPage($page=null, $limit=null, $condition=null){
		$users = $this->getModel ( 'Users' );
		$filter= null;
		if($page != null && $limit != null){
			$filter = array(
				'conditions' => $condition,
				'pager' => array(
					'page' => $page,
					'count' => $limit,
					),
				'order' => array(
					'name' => 'created_at',
					'direction' => 'asc',
					),
				);
		}else{
			$filter = array(
				'conditions' => $condition,
				'order' => array(
					'name' => 'created_at',
					'direction' => 'asc',
					),
				);
		}
		$all_users = $users->find($filter);
		return $all_users;
	}

	// -----------------------------------------------------------
	// Login Check
	// -----------------------------------------------------------
	
	public function getUserBySession($session) {
		$users = $this->getModel ( 'Users' );
		if (isset ( $session ['login_id'] )) {
			return $users->findOne ( array (
				'id' => $session ['login_id'] 
				) );
		}
	}
}