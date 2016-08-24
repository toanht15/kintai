<?php
AAFW::import('jp.aainc.aafw.base.aafwPOSTActionBase');
AAFW::import('jp.aainc.classes.entities.User');
AAFW::import('jp.aainc.aafw.db.aafwDataBuilder');

class update_password extends aafwPOSTActionBase {
	public $Secure = true;
	
	protected $ContainerName = 'update_password';
	protected $ErrorPage = 'redirect: /user/change_password';
	protected $Form = array(
		'action' => 'user',
		'package' => 'update_password',
		);
	
	protected $_ModelDefinitions = array(
		'Users',
		);
	
	public function doThisFirst() {
		if( !isset($_SESSION['login_id']) )
		{					
			return 'redirect: /user/login';
		}
	}
	
	public function validate() {
		return true;
	}
	
	public function doAction() {
	
	echo $this->password;
	die();

	}
}