<?php
AAFW::import('jp.aainc.aafw.base.aafwEntityBase');

class User extends aafwEntityBase {
	protected $_Relations = array(
		'TimeSheets' => array(
			'id' => 'user_id'
			)
		);
}