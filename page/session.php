<?php
class page_session extends Page {
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('Session');

		if(!$crud->isEditing()){
			$crud->grid->addColumn('Button','mark_current');
			if($_GET['mark_current']){
				$session=$this->add('Model_Session');
				$session->load($_GET['mark_current']);
				if(!$session['is_current'])
					$session->markCurrent();
				$crud->grid->js(null,$crud->js()->univ()->successMessage('Session Changed'))->reload()->execute();
			}
		
		}

	}
}