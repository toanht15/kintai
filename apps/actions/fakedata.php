<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class fakedata extends aafwGETActionBase {

	public function validate() {
		return true;
	}

	public function doAction() {
		$service = $this->createService('UserService');
		$timesheet_service = $this->createService('TimeSheetService');
		$report_service = $this->createService('ReportService');

		// $password = 'password';

		// for ($i=1; $i < 20; $i++) {
		// 	$email = 'example'.$i.'@atb.com';
		// 	$service->createUser($email, $password);
		// }

		// $users = $service->getAllUser();
		// foreach ($users as $user) {
		// 	$timesheet_service->createTimeSheet($user->id);
		// }

		// $timesheets = $timesheet_service->getAllTimeSheet();
		// foreach ($timesheets as $t) {
		// 	$report = new Report();
		// 	$report->timesheet_id = $t->id;
		// 	$report->content = '================================
		// 	1) My activities today have been …
		// 	(TODO)

		// 	2) I have achieved the following results …
		// 	(PROGRESS)

		// 	3) Expected work for tomorrow …
		// 	(NEXT-TODO)

		// 	4) I am having difficulties with and need assistance with …
		// 	(ISSUES)
		// 	';
		// 	$report = $report_service->createReport($report);
		// }

		// foreach ($users as $user) {
		// 	$timesheet_service->updateCheckOutTime($user);
		// }

		echo "Fake data successfully";
	}
}
