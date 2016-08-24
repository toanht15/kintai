<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class add extends aafwGETActionBase {

	public $Secure = true;

	public function validate() {
		return true;
	}

	public function doThisFirst(){
		if( !isset($_SESSION['login_id']) )
		{					
			return 'redirect: /user/login';
		}
	}
	
	public function doAction() {

		return '/report/add.php';

	}
}