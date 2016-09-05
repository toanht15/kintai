<?php

class Util {

    public static function getCorrectPaging($paging, $total_page) {
        $aafwObject = new aafwObject();

        if (!$aafwObject->isNumeric($paging)
            || $aafwObject->isEmpty($paging)
            || $paging <= 0
        ) {
            return 1;
        }

        if ($paging > $total_page) {
            return $total_page;
        }

        return $paging;
    }

    public function setMessageTimeSheetAction($status) {
        switch ($status) {
        case '1':
            return config('@message.user.login');
                break;
        case '2':
            return config('@message.timesheet.check_in');
                break;
        case '3':
            return config('@message.timesheet.checked_in');
                break;
        case '4':
            return config('@message.timesheet.check_out');
                break;
        case '5':
            return config('@message.timesheet.has_report');
                break;
        default:
            break;
        }
    }

    public function setMessageAdminAction($status) {
        switch ($status) {
        case '1':
            return config('@message.admin.update');
                break;
        case '2':
            return config('@message.admin.password_reset');
                break;
        case '3':
            return config('@message.admin.delete');
                break;
        default:
            return false;
                break;
        }
    }
}
