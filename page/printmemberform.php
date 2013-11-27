<?php

class page_printmemberform extends Page {
	function init(){
		parent::init();

		$m=$this->add('Model_Registration')->load($_GET['registration_id']);
		$v=$this->add('View_MemberForm');
		$v->setModel($m);
		$tc=$this->add('View_TermCondition');
		$tc->setModel($this->add('Model_TermsCondition')->tryLoad($m['t_and_c_id']));
	}
}