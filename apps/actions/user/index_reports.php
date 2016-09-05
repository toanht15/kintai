<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class index_reports extends aafwGETActionBase {

    public $Secure = true;

    public function validate() {
        return true;
    }

    public function doThisFirst() {
        if (!isset($_SESSION['login_id'])) {
            return 'redirect: /user/login';
        }
    }

    public function doAction() {
        $service = $this->createService('UserService');
        $reports = $service->getAllReportOfUser($this->user_id);
        $user    = $service->getUserById($this->user_id);

        $this->Data['user']    = $user;
        $this->Data['reports'] = $reports;
        return 'user/index_reports.php';
    }
}
