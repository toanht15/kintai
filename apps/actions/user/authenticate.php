<?php
AAFW::import('jp.aainc.aafw.base.aafwPOSTActionBase');

class authenticate extends aafwPOSTActionBase {
    public $Secure = true;

    protected $ContainerName = 'login';
    protected $ErrorPage     = 'redirect: /user/login';

    protected $Form = array(
                       'action'  => 'login',
                       'package' => 'user',
                      );

    protected $_ModelDefinitions = array('Users');

    protected $ValidatorDefinition = array(
        'email' => array(
            'required'=> 1,
            'type'    => 'str',
            'length'  => 75,
            ),
        'password' => array(
            'required'=> 1,
            'type'    => 'str',
            'length'  => 128,
            ),
        );

    public function doThisFirst() {
        if ($this->SERVER['REQUEST_METHOD'] == 'GET') {
            return 'redirect: /user/login';
        }

        return true;
    }

    public function validate() {
        if (!$this->isMailAddress($this->email)) {
            $this->Validator->setError('email', 'INVALID_MAIL_ADDRESS');
        } else {
            $service = $this->createService('UserService');
            $user    = $service->getUserByEmail($this->email);
            if (!$user || ($user->status == 1)) {
                $this->Validator->setError('login', 'LOGIN_ERROR');
            }

            $user = $service->authenticate($user->email, $this->password);
            if (!$user) {
                $this->Validator->setError('login', 'LOGIN_ERROR');
            } else {
                $this->Data['user'] = $user;
            }
        }

        return $this->Validator->isValid();
    }

    public function doAction() {
        if ($this->Data['user']) {
            session_regenerate_id(true);
            $this->SESSION['login_id'] = $this->Data['user']->id;
            $service = $this->createService('UserService');

            if ($this->Data['user']->isAdmin) {
                $this->SESSION['isAdmin'] = $this->Data['user']->isAdmin;
                $result = 'redirect: /admin/index';
            } else {
                $result = 'redirect: /timesheet/index?status=1';
            }

            $this->Data['saved'] = 1;
        } else {
            $result = 'redirect: /user/login/';
        }

        return $result;
    }
}
