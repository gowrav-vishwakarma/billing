<?php
class page_receivePayment extends Page {
	function init(){
		parent::init();

		$this->api->stickyGET('bill_id');

		$form=$this->add('Form');

		$pr=$this->add('Model_PaymentReceived');
		$pr->addCondition('bill_id',$_GET['bill_id']);
		$form->setModel($pr);

		$form->addSubmit("Receive");

		if($form->isSubmitted()){
			$form->update();
			$form->js(null,$form->js()->_selector(".bill_report_grid")->trigger('reload_me'))->univ()->closeDialog()->execute();
		}


	}
}