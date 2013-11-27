<?php

class ItemList extends CompleteLister{
	public $i=1;
	function formatRow(){
		parent::formatRow();
		$this->current_row['sno'] = $this->i++;
	}
}

class View_BillReport extends View{
	function init(){
		parent::init();
	
	}

	function setModel($model){
		$iv = $this->add('ItemList',null,'item_spot',array('view/bill_details'));
		$iv->setModel($model->ref('BillDetail'));
		$extrarows = 20 - $model->count()->getOne();
		for ($i=1; $i<=$extrarows; $i++)
			$iv->add('View',null,'ExtraRows',array('view/extrarows'));
		parent::setModel($model);
		$this->template->trySet('at_rate',round($this->model['at_rate'],0));
	}
	
	function defaultTemplate(){
		return array('view/report');
	}
}