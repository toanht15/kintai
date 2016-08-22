<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class index extends aafwGETActionBase {

	public function validate() {
		return true;
	}

	public function doAction() {
		$user_service = $this->createService('UserService');

		$current_user = $user_service->getUserBySession($this->SESSION);
		$timesheet = $user_service->getTodayTimeSheet($current_user);
		if($timesheet) $checked_in = true; else $checked_in = false;

		if($user_service->isCheckedOut()) $checked_out =true; else $checked_out = false;
		

		$this->Data['checked_in'] = $checked_in;
		
		return 'timesheet/index.php';
	}
}
