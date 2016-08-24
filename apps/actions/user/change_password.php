<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class change_password extends aafwGETActionBase {

	public $Secure = true;

	public function validate() {
		return true;
	}

	public function doAction() {

		return '/user/changePassword.php';

	}
}