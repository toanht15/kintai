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
		//$reports = $service->getAllRepostOfUser($user);
		$reports = $service->getAllRepost();
		// foreach ($reports as $r) {
		// 	$u = $service->getUserOfReport($r);
		// 	echo $u->email;
		// }
		// die();

		$this->Data['reports'] = $reports;
		return 'report/index.php';
	}
}