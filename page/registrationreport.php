<?php

class page_registrationreport extends Page {
	function init(){
		parent::init();


		if($_GET['edit']){
			$this->js()->univ()->redirect($this->api->url('registration',array('registration_id'=>$_GET['edit'])))->execute();
		}

		if($_GET['print']){
			$this->js()->univ()->redirect($this->api->url('printmemberform',array('registration_id'=>$_GET['print'])))->execute();
		}

		$grid = $this->add('Grid');
		$grid->setModel('Registration');

		$grid->addColumn('Button','edit');
		$grid->addColumn('Button','print');
		$grid->addColumn('Confirm','delete');
		$grid->addPaginator(20);
		
		if($_GET['delete']){
			$this->add('Model_Registration')->load($_GET['delete'])->delete();
			$grid->js(null,$grid->js()->univ()->successMessage("Deleted"))->reload()->execute();
		}

	}
}