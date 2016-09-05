<?php
AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');
class index_user extends aafwGETActionBase {
    const PAGE_LIMIT = 15;

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
        $service = $this->createService('UserService');

        $total_count = $service->totalCount();
        $this->Data['page_limited']     = self::PAGE_LIMIT;
        $this->Data['total_file_count'] = $total_count;
        $total_page = (floor($total_count / self::PAGE_LIMIT) + ($total_count % self::PAGE_LIMIT > 0));

        $this->p = Util::getCorrectPaging($this->p,$total_page);

        $offset = (($this->p - 1) * $this->Data['page_limited']);
        $params = array(
                   'limit'  => $this->Data['page_limited'],
                   'offset' => $offset,
                  );

        $users = $service->getUsersByPage($params);

        $this->Data['users']         = $users;
        $this->Data['flash_message'] = Util::setMessageAdminAction($this->status);

        return '/admin/index_user.php';
    }
}
