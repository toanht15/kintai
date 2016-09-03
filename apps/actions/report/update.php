<?php
AAFW::import('jp.aainc.aafw.base.aafwPOSTActionBase');
AAFW::import('jp.aainc.classes.entities.Report');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class update extends aafwPOSTActionBase {
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
		if( !isset($_SESSION['login_id']) )
		{
			return 'redirect: /user/login';
		}
	}

	public function validate() {
		return true;
	}

	public function doAction() {
		$service = $this->createService('ReportService');
		$report = $service->updateReport($this->report_id, $this->content);
		$this->Data['report'] = $report;

		return 'redirect: /report/show?id='.$report->id;
	}
}