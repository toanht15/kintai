<?php
 AAFW::import('jp.aainc.aafw.base.aafwGETActionBase');
 
 class logout extends aafwGETActionBase {
 	public $Secure = true;
 	
 	protected $ContainerName = 'logout';
 	
 	public function validate() {
 		return true;
 	}
 	
 	public function doAction() {
 		$this->SESSION = array();
 		session_destroy();
 		return 'redirect: /user/login';
 	}
 }