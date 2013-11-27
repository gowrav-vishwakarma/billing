<?php
class Model_Session extends Model_Table {
	var $table= "session";
	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('is_current')->type('boolean');
		$this->hasMany('Bill','seesion_id');
		$this->add('dynamic_model/Controller_AutoCreator');



	}

	function markCurrent(){
		$session=$this->add('Model_Session');
		foreach ($session as $junk) {
			$session['is_current']=0;
			$session->save();
		}
		$this['is_current']=1;
		$this->save();
	}
}