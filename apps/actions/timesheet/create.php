<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class create extends aafwGETActionBase {

	public $Secure = true;

	public function validate() {
		return true;
	}

	public function doAction() {
		$service = $this->createService('TimeSheetService');
		
		$user = $service->getUserBySession($this->SESSION);
		$timesheet = $service->createTimeSheet($user->id);

		$this->Data['timesheet'] = $timesheet;
		return '/timesheet/test.php';

	}
}