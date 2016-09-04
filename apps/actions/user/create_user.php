<?php

AAFW::import('jp.aainc.aafw.base.aafwPOSTActionBase');
AAFW::import('jp.aainc.classes.entities.User');

class create_user extends aafwPOSTActionBase {

    public $Secure = true;

    protected $ContainerName = 'register';
    protected $ErrorPage     = 'redirect: /user/register';

    protected $Form = array(
                       'action'  => 'register',
                       'package' => 'user',
                      );

    protected $_ModelDefinitions = array('Users');

    protected $ValidatorDefinition = array(
        'email' => array(
            'required' => 1,
            'type' => 'str',
            ),
        'password' => array(
            'required' => 1,
            'type'     => 'str',
            )
        );

    public function doThisFirst() {
        if (!isset($_SESSION['login_id'])) {
            return 'redirect: /user/login';
        }

        if ($this->SERVER['REQUEST_METHOD'] == 'GET') {
            return 'Invalid information';
        }

        return true;
    }

    public function validate() {
        $this->Data['user'] = $this->REQUEST['User'];
        $service            = $this->createService('UserService');

        if (!$this->isMailAddress($this->email)) {
            $this->Validator->setError('email', 'INVALID_EMAILADDRESS');
        }

        if ($service->getUserByEmail($this->email)) {
            $this->Validator->setError('email', 'EXISTED_USER');
        }

        return $this->Validator->isValid();
    }

    public function doAction() {
        $service = $this->createService('UserService');

        $param           = new User();
        $param->email    = $this->email;
        $param->password = $this->password;
        $user            = $service->createUser($this->email, $this->password);

        $this->Data['user'] = $user;
        return 'redirect: /index';
    }
}
