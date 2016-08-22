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
		// if ($this->User) {
		// 	return 'redirect: /user/register';
		// }
		// if ($this->SERVER['REQUEST_METHOD'] == 'GET') {
		// 	return 'Invalid information';
		// }
		// return true;
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

		$report = new Report();
		$report->timesheet_id = $timesheet->id;
		$report->content = $this->content;
		$report = $service->createReport($report);

		return 'redirect: /index';
	}
}

?>