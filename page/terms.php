<?php
class page_terms extends Page {
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('TermsCondition');

	}
}