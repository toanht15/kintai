<?php
AAFW::import('jp.aainc.aafw.base.aafwPOSTActionBase');
AAFW::import('jp.aainc.classes.entities.Report');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class edit extends aafwPOSTActionBase {
	public $Secure = true;
	
	protected $ContainerName = 'edit';
	protected $ErrorPage = 'redirect: /report/edit';
	protected $Form = array(
		'action' => 'edit',
		'package' => 'report',
	);
	
	protected $_ModelDefinitions = array(
		'Reports', 'Users',
	);
	
	public function doThisFirst() {
		return true;
	}
	
	public function validate() {
		return true;
	}
	
	public function doAction() {
		$service = $this->createService('ReportService');
		$report = $service->getReportById($this->report_id);

		// $user_service =$this->createService('UserService');
		// $user = $user_service->getUserBySession($this->SESSION);

		// $check = $service->checkReportUser($report, $user);

		// $this->Data['check'] = $check;
		$this->Data['report'] = $report;	
		
		return 'report/edit.php';
	}
}