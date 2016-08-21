<?php
AAFW::import ( 'jp.aainc.lib.base.aafwServiceBase' );
AAFW::import('jp.aainc.classes.entities.TimeSheet');
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.classes.entities.Report');

class ReportService extends aafwServiceBase {

	public function createReport($tmp){
		$reports = $this->getModel('Reports');

		$report = $tmp;
		$reports->save($report);
		return $report;
	}

	public function getAllRepostOfUser($user){
		$timesheets = $this->getModel('TimeSheets');
		$filter = array('conditions'=>array('id'=>1));
		$timesheet = $timesheets->find($filter);
		echo "<pre>"; var_dump($timesheet); die();
		echo $timesheet->status; die();

	}

}