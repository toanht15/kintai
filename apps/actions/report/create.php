<?php 

AAFW::import('jp.aainc.aafw.base.aafwPOSTActionBase');
AAFW::import('jp.aainc.classes.entities.Report');
AAFW::import('jp.aainc.classes.services.TimeSheetService');


class create extends aafwPOSTActionBase {

	public $Secure = true;

	protected $ContainerName = 'add';
	protected $ErrorPage = 'redirect: /report/add';
	protected $Form = array(
		'action' => 'add',
		'package' => 'report',
		);
	
	protected $_ModelDefinitions = array(
		'Reports',
		);

	protected $ValidatorDefinition = array(
		'content' => array(
			'required' => 1,
		)
		);
	
	public function doThisFirst() {
		if( !isset($_SESSION['login_id']) )
		{					
			return 'redirect: /user/login';
		}

		if ($this->SERVER['REQUEST_METHOD'] == 'GET') {
			return 'Invalid information';
		}
		return true;
	}
	
	public function validate() {
	return true;
	}
	
	public function doAction() {	
		$service = $this->createService('ReportService');
		$user_service = $this->createService('UserService');
		$timesheet_service = $this->createService('TimeSheetService');

		$user = $user_service->getUserBySession($this->SESSION);
		$timesheet = $timesheet_service->getTimeSheet($user);

		if(!$user_service->hasReport($user)){
		$report = new Report();
		$report->timesheet_id = $timesheet->id;
		$report->content = $this->content;
		$report = $service->createReport($report);

		return 'redirect: /report/show?id='.$report->id;
	}

		return 'redirect: /timesheet/index?has_report=1';
	}
}

?>