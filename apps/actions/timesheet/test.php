<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class test extends aafwGETActionBase {

	public function validate() {
		return true;
	}

	public function doAction() {
		return 'timesheet/test.php';
	}
}
