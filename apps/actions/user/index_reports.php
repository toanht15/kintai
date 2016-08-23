<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class index_reports extends aafwGETActionBase {

	public $Secure = true;

	public function validate() {
		return true;
	}

	public function doAction() {
		//$user_service = $this->createService('UserService');
		//$user = $user_service->getUserBySession($this->SESSION);

		$service = $this->createService('UserService');
		//$reports = $service->getAllRepostOfUser($user);
		$reports = $service->getAllRepostOfUser($this->user_id);
		$user = $service->getUserById($this->user_id);
		
		$this->Data['user'] = $user;
		$this->Data['reports'] = $reports;
		return 'user/index_reports.php';
	}
}