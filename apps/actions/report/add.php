<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class add extends aafwGETActionBase {

	public $Secure = true;

	public function validate() {
		return true;
	}

	public function doAction() {

		return '/report/add.php';

	}
}