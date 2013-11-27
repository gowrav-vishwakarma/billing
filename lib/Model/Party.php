<?php

class Model_Party extends Model_Table {
	var $table= "party";
	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('address');

		$this->hasMany('Bill','party_id');

		$this->addHook('beforeDelete',$this);
		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeDelete(){
		if($this->ref('Bill')->count()->getOne() > 0 )
			throw $this->exception('Party Contains Bills, Cannot Delete');
	}
}