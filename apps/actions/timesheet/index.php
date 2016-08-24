<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class index extends aafwGETActionBase {

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
		$timesheet = $user_service->getTodayTimeSheet($current_user);

		if($timesheet) $checked_in = true; else $checked_in = false;
		if($user_service->isCheckedOut($current_user)) $checked_out =true; else $checked_out = false;
		if($user_service->hasReport($current_user)) $hasReport = true; else $hasReport = false;

		if($this->login) $this->Data['flash_message'] = "Login successfull.";
		if($this->check_in) $this->Data['flash_message'] = "Check in successfull.	Enjoy your working day.";
		if($this->checked_in) $this->Data['flash_message'] = "You have been checked in.";
		if($this->checked_out) $this->Data['flash_message'] = "Check out successfull.";
		if($this->has_report) $this->Data['flash_message'] = "You have report today.";

		$this->Data['hasReport'] = $hasReport;
		$this->Data['checked_in'] = $checked_in;
		$this->Data['checked_out'] = $checked_out;

		return 'timesheet/index.php';
	}
}
