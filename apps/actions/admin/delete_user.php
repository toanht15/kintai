<?php
AAFW::import('jp.aainc.aafw.base.aafwPOSTActionBase');
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class delete_user extends aafwPOSTActionBase {
    public $Secure = true;

    protected $ContainerName = 'index_user';
    protected $ErrorPage     = 'redirect: /admin/index_user';

    protected $Form = array(
                       'action'  => 'index_user',
                       'package' => 'admin',
                      );

    protected $_ModelDefinitions = array('Users');

    public function doThisFirst() {
        if (!isset($_SESSION['login_id'])) {
            return 'redirect: /user/login';
        }

        if (!isset($_SESSION['isAdmin'])) {
            return 'redirect: /timsheet/index';
        }

        if ($this->SERVER['REQUEST_METHOD'] == 'GET') {
            return 'Invalid information';
        }

        return true;
    }

    public function validate() {
        return true;
    }

    public function doAction() {
        $service = $this->createService('UserService');
        $service->deleteUser($this->user_id);
        return 'redirect: /admin/index_user?status=3';
    }
}
