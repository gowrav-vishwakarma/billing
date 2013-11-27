<?php

class Form_Field_Address extends Form_Field_Line{
	function init(){
		parent::init();
		$this->addClass('atk-form-field-readonly address');
	}
}