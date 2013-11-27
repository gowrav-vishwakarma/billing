<?php
class Model_Bill extends Model_Table {
	var $table= "bill_master";
	function init(){
		parent::init();

		$this->hasOne('Party','party_id')->sortable(true);
		$this->hasOne('Session','session_id');
		$this->addField('name')->caption('Bill Number')->sortable(true);
		$this->addField('total_amount')->type('money')->caption('Amount')->sortable(true);
		$this->addField('tax')->type('money')->caption("Applied Tax in %")->sortable(true);
		$this->addField('service_charge_per')->type('money')->caption("Service Charge in %")->sortable(true);
		$this->addField('service_charge')->type('money')->caption("Service Charge")->sortable(true);
		$this->addField('grand_total')->type('money')->caption("Grand Total")->sortable(true);
		$this->addField('net_amount')->type('money')->caption("Net Amount")->sortable(true);
		$this->addField('date')->type('date');
		// $this->addField('period');
		$this->hasMany('BillDetail','bill_id');
		$this->hasMany('PaymentReceived','bill_id');

		$this->addExpression('tax_amount')->set('ROUND(total_amount * tax / 100,2)')->type('money')->sortable(true);
		$this->addExpression('bill_amount')->set('ROUND(total_amount + (total_amount * tax / 100) + service_charge,2)')->type('money')->sortable(true);
		;
		$this->addExpression('received_amount')->set(function($m,$q){
			return $m->refSQL('PaymentReceived')->sum('amount_submitted');
		})->sortable(true);

		$this->addExpression('period')->set( "DATE_FORMAT(`date`,'%M %y')");

		$this->addHook('beforeDelete',$this);

		$this->add('dynamic_model/Controller_AutoCreator');

	}

	function beforeDelete(){
		$this->ref('BillDetail')->deleteAll();
	}

	// function beforeSave(){
	// 	throw $this->exception('HI there','ValidityCheck')->setField('bill_no');
	// }

	function newBillNo(){

		$bill=$this->add('Model_Bill');
		$lastbill_no = $bill
							->addCondition('session_id',$this->add('Model_CurrentSession')->tryLoadAny()->get('id'))
							->_dsql()->del('field')->field('max(name)')->getOne();
		return $lastbill_no+1;

	}
}	