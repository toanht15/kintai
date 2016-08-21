<?php
AAFW::import('jp.aainc.aafw.base.aafwEntityBase');

class Report extends aafwEntityBase {
	protected $_Relations = array(
		'TimeSheets' => array(
			'timesheet_id' => 'id'
			)
		);
}