<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class create extends aafwGETActionBase {

	public $Secure = true;

	public function validate() {
		return true;
	}

	public function doAction() {
		
		$user_service = $this->createService('UserService');
		$user = $user_service->getUserBySession($this->SESSION);

		if(!$user_service->getTodayTimeSheet($user)){
			$service = $this->createService('TimeSheetService');		
			$timesheet = $service->createTimeSheet($user->id);
		}

		$this->Data['timesheet'] = $timesheet;
		$this->Data['flash_message'] = 'Successfull';
		return 'redirect: /timesheet/index';

	}
}