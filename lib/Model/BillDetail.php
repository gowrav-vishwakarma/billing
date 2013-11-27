<?php

class Model_BillDetail extends Model_Table {
	var $table= "bill_detail";
	function init(){
		parent::init();

		$this->hasOne('Bill','bill_id');
		$this->hasOne('Item','item_id');
		$this->addField('remarks');
		$this->addField('unit')->type('money');
		$this->addField('rate')->type('money');
		$this->addField('at_rate');
		$this->addField('per');
		$this->addField('amount')->type('money');

		$this->add('dynamic_model/Controller_AutoCreator');

	}
}