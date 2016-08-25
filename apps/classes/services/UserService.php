<?php
AAFW::import ( 'jp.aainc.lib.base.aafwServiceBase' );
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class UserService extends aafwServiceBase {
	const STRETCH_COUNT = 5;
	const FIXED_SALT = 'edc21dc921dcc1285d9b740b833af2c72bc0afc960b48ae5c9d00c14bda400bb';
	
	/**
	 *
	 * @param
	 *        	$email
	 * @return string
	 */
	private function getSalt($email) {
		return $email . pack ( 'H*', self::FIXED_SALT );
	}
	
	/**
	 *
	 * @param
	 *        	$email
	 * @param
	 *        	$password
	 * @return string
	 */
	public function getEmailHash($email, $password) {
		$salt = $this->getSalt ( $email );
		$hash = '';
		for($i = 0; $i < self::STRETCH_COUNT; $i ++) {
			$hash = hash ( 'sha256', $hash . $password . $salt );
		}
		return $hash;
	}
	
	/**
	 *
	 * @param
	 *        	$email
	 * @return mixed
	 */
	public function getUserByEmail($email) {
		$users = $this->getModel ( 'Users' );
		return $users->findOne ( array (
			'email' => $email 
			) );
	}
	
	/**
	 *
	 * @param User $user        	
	 */
	public function updateLastLogin($user) {
		$users = $this->getModel ( 'Users' );
		$user->last_login = date ( 'Y/m/d H:i:s' );
		$users->save ( $user );
	}
	
	/**
	 *
	 * @param
	 *        	$username
	 * @param
	 *        	$password
	 * @return mixed
	 */
	// public function authenticate($username, $password) {
	// 	$password = $this->getUsernameHash ( $username, $password );
	// 	$users = $this->getModel ( 'Users' );
	// 	$user = $users->findOne ( array (
	// 			'username' => $username,
	// 			'password' => $password 
	// 	) );
	// 	return $user;
	// }

	public function authenticate($email, $password) {
		$password = $this->getEmailHash ( $email, $password );
		$users = $this->getModel ( 'Users' );
		$user = $users->findOne ( array (
			'email' => $email,
			'password' => $password 
			) );
		return $user;
	}
	
	/**
	 *
	 * @param
	 *        	$username
	 * @param
	 *        	$email
	 * @param
	 *        	$password
	 * @return User
	 */
	// public function createUser($username, $email, $password) {
	// 	$users = $this->getModel('Users');
	// 	$user = new User();
	// 	$user->username = $username;
	// 	$user->email = $email;
	// 	$user->profile_picture = '/img/member_avata/default.gif';
	// 	$user->status = 0;
	// 	$user->password = $this->getUsernameHash($username, $password);
	// 	$user->last_login = date('Y/m/d H:i:s');
	// 	$users->save($user);		
	// 	return $user;
	// }

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


	/**
	 *
	 * @param
	 *        	$user_id
	 * @param
	 *        	$newStatus
	 * @return User
	 */
	public function changeStatus($user_id, $newStatus) {
		$users = $this->getModel('Users');
		$user = $users->findOne ( array (
			'id' => $user_id
			) );
		$user->status = $newStatus;
		$users->save($user);
		return $user;
	}
	
	
	/**
	 * 
	 * @param unknown $tmp
	 * @return unknown
	 */
	public function updateUser($tmp) {
		$users = $this->getModel('Users');
		$user = $this->getUserByName($tmp->username);
		
		$user->email = $tmp->email;
		$user->birthdate = $tmp->birthdate;
		$user->birthplace = $tmp->birthplace;
		$user->costellation = $tmp->costellation;
		$user->blood_type = $tmp->blood_type;
		$user->description = $tmp->description;
		$user->last_login = date('Y/m/d H:i:s');
		try {
			$users->save($user);
		} catch (Exception $e) {
			var_dump($e); exit(1);
		}	
		return $user;
	}
	
	/**
	 *
	 * @param email, new password
	 * @return User
	 */
	public function changePassword($user, $newPassword) {
		$users = $this->getModel('Users');
		$user = $this->getUserByEmail($user->email);
		$newPassword = $this->getEmailHash($user->email, $newPassword);
		$user->password = $newPassword;
		$users->save($user);
		return $user;
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 * @return mixed
	 */
	public function getUserById($id) {
		$users = $this->getModel ( 'Users' );
		return $users->findOne ( array (
			'id' => $id 
			) );
	}
	
	
	public function changeAvata($user_id,$file_type){
		$users = $this->getModel('Users');
		$user = $users->findOne ( array (
			'id' => $user_id
			));
		$user->profile_picture = '/img/member_avata/'.$user_id.'.'.$file_type;
		$users->save($user);
		return $user;
	}
	/**
	 *
	 * @param
	 *        	$username
	 * @return mixed
	 */
	public function getUserByName($username) {
		$users = $this->getModel ( 'Users' );
		return $users->findOne ( array (
			'username' => $username 
			));
	}
	
/**
 * 
 */
public function totalCount($filter=null ) {
	$users = $this->getModel ( 'Users' );
	return $users->count($filter);
}
	/**
	 * 
	 * @param string $page
	 * @param string $limit
	 * @param string $condition
	 * @return unknown
	 */
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
	
	/**
	 *
	 * @param
	 *        	$session
	 * @return mixed
	 */
	public function getUserBySession($session) {
		$users = $this->getModel ( 'Users' );
		if (isset ( $session ['login_id'] )) {
			return $users->findOne ( array (
				'id' => $session ['login_id'] 
				) );
		}
	}
}