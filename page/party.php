<?php


class page_party extends Page {
	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Party');

	}
}