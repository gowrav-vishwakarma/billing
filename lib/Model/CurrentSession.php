<?php
class Model_CurrentSession extends Model_Session{
	function init(){
		parent::init();

		$this->addCondition('is_current',1);
		
	}
}