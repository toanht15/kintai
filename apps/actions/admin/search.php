<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class search extends aafwGETActionBase {

	public function validate() {
		return true;
	}

	public function doThisFirst(){
		if( !isset($_SESSION['login_id']) )
		{
			return 'redirect: /user/login';
		}
	}

	public function doAction() {
		$service = $this->createService('UserService');
		$user = $service->getUserBySession($this->SESSION);
		if(!$user->isAdmin)
			return 'redirect: /timesheet/index';
<<<<<<< HEAD
		
=======

>>>>>>> 60216805e16e409b4f783e28e66c441b63d2f020
		$users_checked_in = $service->getUsersCheckedInByDate('2016-08-23');
		$users_not_check_in = $service->getUsersNotCheckInByDate('2016-08-23');

		$this->Data['users_not_check_in'] = $users_not_check_in;
		$this->Data['users_checked_in'] = $users_checked_in;

		return '/admin/index.php';
	}
}
