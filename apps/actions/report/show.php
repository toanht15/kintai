<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class show extends aafwGETActionBase {

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
		$user_service = $this->createService('UserService');
		$current_user = $user_service->getUserBySession($this->SESSION);

		$service = $this->createService('ReportService');
		//$reports = $service->getAllRepostOfUser($user);
		$report = $service->getReportById($this->id);
		$user = $service->getUserOfReport($report);
		$date = $service->getDateOfReport($report);

		if ($current_user == $user) $check = true;
		else $check = false;

		$this->Data['check'] = $check;
		$this->Data['date'] = $date;
		$this->Data['user'] = $user;
		$this->Data['report'] = $report;

		return 'report/show.php';
	}
}