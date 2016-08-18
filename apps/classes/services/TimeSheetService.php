<?php
AAFW::import ( 'jp.aainc.lib.base.aafwServiceBase' );
AAFW::import('jp.aainc.classes.entities.TimeSheet');
AAFW::import('jp.aainc.classes.entities.User');

class TimeSheetService extends aafwServiceBase {

	public function createTimeSheet($user_id) {
		$timesheets = $this->getModel('TimeSheets');
		$timesheet = new TimeSheets();
		$timesheet->user_id = $user_id;
		$timesheet->day = date('Y-m-d');
		$timesheets->save($timesheet);		
		return $timesheet;
	}

	public function getUserBySession($session) {
		$users = $this->getModel ( 'Users' );
		if (isset ( $session ['login_id'] )) {
			return $users->findOne ( array (
					'id' => $session ['login_id'] 
			) );
		}
	}
}