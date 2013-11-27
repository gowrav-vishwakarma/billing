<?php
class page_printbill extends Page{
	function init(){
		parent::init();

		$billreport=$this->add('View_BillReport');
		$bill=$this->add('Model_Bill');
		$bill->load($_GET['bill_id']);
		$billreport->setModel($bill);
		

	}
}