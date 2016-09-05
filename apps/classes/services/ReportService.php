<?php

AAFW::import('jp.aainc.lib.base.aafwServiceBase');
AAFW::import('jp.aainc.classes.entities.TimeSheet');
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.classes.entities.Report');

class ReportService extends aafwServiceBase {
    public $reports;

    public function __construct() {
        $this->reports    = $this->getModel('Reports');
        $this->timesheets = $this->getModel('TimeSheets');
    }

    public function createReport($report) {
        return $this->reports->save($report);
    }

    public function getAllReport() {
        $report = $this->$reports->find(array('order' => array('direction' => 'desc')));

        return $report;
    }

    public function getAllReportWithInfo($params) {
        $db = new aafwDataBuilder();
        return $db->getAllReportInfo($params);
    }

    public function countAllReport() {
        $db     = new aafwDataBuilder();
        $result = $db->countAllReport();
        return reset($result)['COUNT(R.id)'];
    }

    public function getUserOfReport($report) {
        $timesheet = $this->$timesheets->findOne(array('id' => $report->timesheet_id));

        $users = $this->getModel('Users');
        $user  = $users->findOne(array('id' => $timesheet->user_id));

        return $user;
    }

    public function getReportById($id) {
        $report = $this->$reports->findOne(array('id' => $id));

        return $report;
    }

    public function getDateOfReport($report) {
        $timesheet = $this->$timesheets->findOne(array('id' => $report->timesheet_id));

        return $timesheet->day;
    }

    public function updateReport($id, $content) {
        $report          = $this->getReportById($id);
        $report->content = $content;

        return $this->reports->save($report);
    }

    public function checkReportUser($report, $user) {
        $u = $this->getUserOfReport($report);
        if ($u->id == $user->id) {
            return true;
        }

        return false;
    }
}
