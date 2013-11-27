<?php

class Model_PaymentReceived extends Model_Table {
	var $table= "paymentreceived";
	function init(){
		parent::init();
		$this->hasOne('Bill','bill_id')->mandatory(true);
		$this->addField('on_date')->type('date')->defaultValue(date('Y-m-d H:i:s'))->mandatory(true);
		$this->addField('amount_submitted')->type('int')->mandatory(true);
		$this->addField('bank_details');
		$this->addField('cheque_no');
		$this->addField('cheque_date')->type('date');
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}