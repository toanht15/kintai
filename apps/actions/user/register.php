<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');

class register extends aafwGETActionBase {

    public function validate() {
        return true;
    }

    public function doThisFirst() {
        if (!isset($_SESSION['login_id'])) {
            return 'redirect: /user/login';
        }

        if (!isset($_SESSION['isAdmin'])) {
            return 'redirect: /timsheet/index';
        }
    }

    public function doAction() {
        return '/user/register.php';
    }
}
