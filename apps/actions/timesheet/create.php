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

		if($service->getTimeSheet($user)) {
            return 'redirect: /timesheet/test';
        }

        $timesheet = $service->createTimeSheet($user->id);

        
		$this->Data['timesheet'] = $timesheet;
		$this->Data['flash_message'] = 'Successfull';
		return 'redirect: /timesheet/index.php';

	}
}