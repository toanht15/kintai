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

	 public function updateCheckOutTime($user){
	 	$timesheets = $this->getModel('TimeSheets');
		$timesheet = $this->getTimeSheet($user);
		$timesheet->check_out_time = date('Y-m-d H:i:s');
		$timesheet->status = 'Checked out';
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

	public function getTimeSheet($user) {
	    $timesheets = $this->getModel('TimeSheets');
        return $timesheets-> findOne ( array(
           'user_id' => $user->id,
            'day' => date('Y-m-d')
        ));
    }

    public function getAllTimeSheet(){
    	$timesheets = $this->getModel('TimeSheets');
    	return $timesheets->find(array('order'=>array('direction'=>'desc')));
    }
}