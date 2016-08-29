<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class index_user extends aafwGETActionBase {

	public function validate() {
		return true;
	}

	public function doThisFirst(){
		if( !isset($_SESSION['login_id']) )
		{
			return 'redirect: /user/login';
		}

		if( !isset($_SESSION['isAdmin']) )
		{
			return 'redirect: /timsheet/index';
		}
	}

	public function doAction() {
		$service = $this->createService('UserService');
		$users = $service->getAllUser();
		
		$this->Data['users'] = $users;
		if($this->del) $this->Data['flash_message'] = 'User has been deleted successfull.';
		if($this->update) $this->Data['flash_message'] = 'Update successfull.';
		
		return '/admin/index_user.php';
	}
}
