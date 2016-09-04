<?php
AAFW::import('jp.aainc.aafw.base.aafwPOSTActionBase');
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class update_password extends aafwPOSTActionBase {
    public $Secure = true;

    protected $ContainerName = 'change_password';
    protected $ErrorPage     = 'redirect: /user/change_password';

    protected $Form = array(
                       'action'  => 'user',
                       'package' => 'update_password',
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
        if ($this->password != $this->retype_password) {
            $this->Data['flash_message'] = "Password and retype-password not match.";
            return 'user/changePassword.php';
        }

        $service = $this->createService('UserService');
        $user    = $service->getUserBySession($this->SESSION);
        $service->changePassword($user, $this->password);
        $this->Data['flash_message'] = "Change password successfull.";

        return 'user/changePassword.php';
    }
}
