<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class checkout extends aafwGETActionBase {
	public $Secure = true;
	public function validate() {
		return true;
	}

	public function doAction() {

		$user_service = $this->createService('UserService');
		
		$user = $user_service->getUserBySession($this->SESSION);
		if($user_service->getTodayTimeSheet($user) && !$user_service->isCheckedOut($user) && $user_service->hasReport($user)){
		$service = $this->createService('TimeSheetService');
        $timesheet = $service->updateCheckOutTime($user);
    }

		return 'redirect: /timesheet/index';

	}
}