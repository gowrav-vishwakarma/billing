<?php
class Model_TermsCondition extends Model_Table {
	var $table= "terms_condition";
	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('t_and_c')->caption('Terms And Condition')->type('text');
		$this->hasMany('Registration','t_and_c_id');

		$this->add('dynamic_model/Controller_AutoCreator');

	}
}