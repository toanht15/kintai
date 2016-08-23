<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');

class register extends aafwGETActionBase {
	
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

		 $user_service =$this->createService('UserService');
		 $user = $user_service->getUserBySession($this->SESSION);
		 if(!$user->isAdmin)
		 	die("Permission denied.");
		// if ($this->User) {
		// 	return 'login.php';
		// }
		return '/user/register.php';
	}
}