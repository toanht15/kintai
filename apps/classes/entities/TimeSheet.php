<?php
AAFW::import('jp.aainc.aafw.base.aafwEntityBase');

class TimeSheet extends aafwEntityBase {
	protected $_Relations = array(
		'Users' => array(
			'user_id' => 'id'
			),
		'Reports' => array(
			'id' => 'timesheet_id'
			)
		);
}