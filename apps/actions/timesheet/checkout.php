<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class checkout extends aafwGETActionBase {
	public $Secure = true;
	public function validate() {
		return true;
	}

	public function doAction() {
		$service = $this->createService('TimeSheetService');
		$user = $service->getUserBySession($this->SESSION);
        $timesheet = $service->updateCheckOutTime($user);

		$this->Data['timesheet'] = $timesheet;
		return 'redirect: /timesheet/index';

	}
}