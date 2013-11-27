<?php
class page_test extends Page {
	function init(){
		parent::init();

		$this->add('BasicAuth')
			 ->allow('demo','demo')
			 ->check();

	$crud=$this->add('CRUD');
	$crud->setModel('Item');

	if($crud->grid){
		$crud->grid->addPaginator(2);
		$crud->grid->addQuickSearch(array('name'));

	}

	}
}