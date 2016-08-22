<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class index extends aafwGETActionBase {

	public $Secure = true;

	public function validate() {
		return true;
	}

	public function doAction() {
		$user_service = $this->createService('UserService');
		$user = $user_service->getUserBySession($this->SESSION);

		$service = $this->createService('ReportService');
		$reposts = $service->getAllRepostOfUser($user);
	}
}