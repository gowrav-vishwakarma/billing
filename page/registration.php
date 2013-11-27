<?php

class page_registration extends Page {
	function init(){
		parent::init();
		$this->api->stickyGET('registration_id');

		$form=$this->add('Form_Registration',array('registration_id'=>($_GET['registration_id']?:null)));
		$form->js(true)->_selector('input')->univ()->disableEnter();

		if($form->isSubmitted()){
			$form->update();
			$msg = ($_GET['registration_id'])? "Member Updated":"Member Added";
			$form->js(null,$form->js()->univ()->successMessage($msg))->reload()->execute();
		}
	}
}