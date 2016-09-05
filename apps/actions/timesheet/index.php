<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class index extends aafwGETActionBase {

    public function validate() {
        return true;
    }

    public function doThisFirst() {
        if (!isset($_SESSION['login_id'])) {
            return 'redirect: /user/login';
        }
    }

    public function doAction() {
        $user_service = $this->createService('UserService');
        $current_user = $user_service->getUserBySession($this->SESSION);

        $this->Data['status']        = $user_service->getStatus($current_user);
        $this->Data['flash_message'] = Util::setMessageTimeSheetAction($this->status);

        return 'timesheet/index.php';
    }
}
