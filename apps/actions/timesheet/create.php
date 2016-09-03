<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class create extends aafwGETActionBase {

	public $Secure = true;

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

		$user_service = $this->createService('UserService');
		$user = $user_service->getUserBySession($this->SESSION);

		if(!$user_service->getTodayTimeSheet($user)){
			$service = $this->createService('TimeSheetService');
			$timesheet = $service->createTimeSheet($user->id);
			return 'redirect: /timesheet/index?status=2';
		}

		return 'redirect: /timesheet/index?status=3';
	}
}