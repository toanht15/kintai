<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');

class login extends aafwGETActionBase {
	public $Secure = true;
	
	protected $ContainerName = 'login';
	
	public function validate() {
		return true;
	}

	public function doThisFirst(){
		if( isset($_SESSION['login_id']) )
		{					
			return 'redirect: /timesheet/index';
		}
	}
	
	public function doAction() {
		// if ($this->User) {
		// 	return 'redirect: /post/top/';
		// }
		// if($this->Admin){
		// 	return 'redirect: /admin/index/';
		// }
		return 'user/login.php';
	}
}