<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class index extends aafwGETActionBase {

	public function validate() {
		return true;
	}

	public function doAction() {
		return 'timesheet/index.php';
	}
}
