<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');

class register extends aafwGETActionBase {
	
	public function validate() {
		return true;
	}
	
	public function doAction() {
		// if ($this->User) {
		// 	return 'login.php';
		// }
		return '/user/register.php';
	}
}