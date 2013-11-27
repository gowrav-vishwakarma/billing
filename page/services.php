<?php

class page_services extends Page {
	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Item');

	}
}