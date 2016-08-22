<?php
AAFW::import ( 'jp.aainc.lib.base.aafwServiceBase' );
AAFW::import('jp.aainc.classes.entities.TimeSheet');
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.classes.entities.Report');

class ReportService extends aafwServiceBase {
	public $reports;

	public function __construct(){
		$this->reports = $this->getModel('Reports');
	}

	public function createReport($report){
		return $this->reports->save($report);		
	}

	public function getAllRepostOfUser($user){
		$timesheets = $this->getModel('TimeSheets');
		$timesheet = $timesheets->find(array('conditions'=>array('user_id'=>$user->id)));
		$arr = array();
		foreach ($timesheet as $t) {
			$arr[] = $t->id;
		}

		$reports = $this->getModel('Reports');
		$report = $reports->find(array('conditions'=>array('timesheet_id'=>$arr)));

		return $report;
	}

	public function getAllRepost(){
		$reports = $this->getModel('Reports');
		$report = $reports->find(array('order'=>array('direction'=>'desc')));

		return $report;
	}

	public function getUserOfReport($report){
		$timesheets = $this->getModel('TimeSheets');
		$timesheet = $timesheets->findOne(array('id' => $report->timesheet_id));

		$users = $this->getModel('Users');
		$user = $users->findOne(array('id'=>$timesheet->user_id));

		return $user;
	}

	public function getReportById($id){
		$reports = $this->getModel('Reports');
		$report = $reports->findOne(array('id'=> $id));

		return $report;
	}

	public function getDateOfReport($report){
		$timesheets = $this->getModel('TimeSheets');
		$timesheet = $timesheets->findOne(array('id' => $report->timesheet_id));

		return $timesheet->day;
	}

	public function updateReport($id, $content){
		$report = $this->getReportById($id);
		$report->content = $content;

		return $this->reports->save($report);
	}

	public function checkReportUser($report, $user){
		$u = $this->getUserOfReport($report);
		if($u->id == $user->id )
			return true;
		return false; 
	}
}