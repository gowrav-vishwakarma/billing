<?php
class Model_Item extends Model_Table {
	var $table= "items";
	function init(){
		parent::init();

		$this->addField('name')->caption('Item Name');
		$this->hasMany('BillDetail','item_id');

		$this->addHook('beforeDelete',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeDelete(){
		if($this->ref('BillDetail')->count()->getOne() > 0 )
			throw $this->exception('This ITem is used in Bill');
	}
}