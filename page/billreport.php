<?php

class page_billreport extends Page {
	function page_index(){
		
		$btn=$this->add('Button')->set('Filter Data');
		$view=$this->add('View');
		$form=$view->add('Form');
		$form->addClass('stacked');
		$form->addField('dropdown','party_id','Party Name')->setEmptyText("Any Party")->setModel('Party');
		$form->addField('DatePicker','from_date');
		$form->addField('DatePicker','to_date');
		$form->addField('line','amount_from');
		$form->addField('line','amount_to');
		// $form->addField('line','submitted_amount_from');
		// $form->addField('line','submitted_amount_to');
		$form->addField('dropdown','amount_type')->setValueList(array(
																	'total_amount'=>'Total_Amount',
																	'grand_total'=>'Grand_Total',
																	'net_amount'=>'Net_Amount',
																	'tax_amount'=>'Tax_Amount',
																	'bill_amount'=>'Bill_Amount',
																	'received_amount'=>'Received_Amount'
																	)
																)->setEmptyText('Please Select Any Amount');
		$form->addClass('atk-row');
		$form->getElement('from_date')->template->set('row_class','span6');
		$form->getElement('to_date')->template->set('row_class','span6');
		$form->addClass('atk-row');
		$form->getElement('amount_from')->template->set('row_class','span6');
		$form->getElement('amount_to')->template->set('row_class','span6');
		$form->add('Order')
			->move($form->addSeparator('atk-row noborder'),'before','from_date')
			->move($form->addSeparator('atk-row noborder'),'after','to_date')
			->now();


		$form->addSubmit('Search');

		$grid=$this->add('Grid');
		$grid->js('reload_me')->reload();
		$grid->addClass('bill_report_grid');


		if($_GET['receive']){
			$this->js()->univ()->frameURL('Receive Payment',$this->api->url('receivePayment',array('bill_id'=>$_GET['receive'])))->execute();
		}

		if($_GET['received_amount']){
			$this->js()->univ()->frameURL('Received Payment Details',$this->api->url('billreport_receivedPaymentDetails',array('bill_id'=>$_GET['received_amount'])))->execute();
		}

		if($_GET['print']){
			$this->js()->univ()->newWindow($this->api->url("printbill",array('bill_id'=>$_GET['print'],'cut_page'=>1)),null,'height=689,width=1246,scrollbar=1')->execute();
		}


		if($_GET['edit']){
			$this->js()->univ()->location($this->api->url("index",array('bill_id'=>$_GET['edit'])),null,'height=689,width=1246,scrollbar=1')->execute();
		}

		if($_GET['delete']){
			$bill_delete=$this->add('Model_Bill');
			$bill_delete->load($_GET['delete']);
			$bill_delete->delete();
			$grid->js(null,$grid->js()->univ()->successMessage("Deleted"))->reload()->execute();
		}

		$bills = $this->add('Model_Bill');
			$bills->addCondition('session_id',$this->add('Model_CurrentSession')->tryLoadAny()->get('id'));

			if($_GET['filter']){

				if($_GET['party_id'])
					$bills->addCondition('party_id',$_GET['party_id']);
				if($_GET['from_date'])
					$bills->addCondition('date','>=',$_GET['from_date']);
				if($_GET['to_date'])
					$bills->addCondition('date','<=',$_GET['to_date']);

				if($_GET['amount_type']){
					if($_GET['amount_from'])
						$bills->addCondition($_GET['amount_type'],'>=',$_GET['amount_from']);

					if($_GET['amount_to'])
						$bills->addCondition($_GET['amount_type'],'<=',$_GET['amount_to']);
					
				}
				
			}






		$grid->setModel($bills);

		$grid->addColumn('Button','receive');
		$pbtn=$grid->addColumn('Button','print');
		$grid->addColumn('Button','edit');
		$grid->addColumn('Confirm','delete');
		$grid->addMethod('format_checkBtn',function($grid,$field){
			if($grid->model['bill_amount'] <= $grid->model['received_amount'])
				$grid->current_row_html[$field]='';
		});

		$grid->addMethod('format_receivedDetails',function($grid,$field){

			if($grid->model['received_amount']==0) {
				$grid->current_row_html[$field] = "0";
				return;
			}
			   $url = $grid->api->url();
		        $class = $grid->columns[$field]['button_class'].' button_'.$field;
		        $icon = isset($grid->columns[$field]['icon'])
		                    ? $grid->columns[$field]['icon']
		                    : '';

			$grid->current_row_html[$field] =
			            '<button type="button" class="'.$class.'" '.
			                'onclick="$(this).univ().ajaxec(\'' .
			                    $url->set(array(
			                        $field => $grid->current_id,
			                        $grid->name.'_'.$field => $grid->current_id
			                    )) . '\')"'.
			            '>'.
			                $icon.
			                $grid->model['received_amount'].
			            '</button>';
		});

		$grid->addFormatter('receive','checkBtn');
		$grid->addFormatter('received_amount','receivedDetails');
		$grid->addPaginator(20);
		// $grid->addTotals();
		$view->js(true)->hide();

		$btn->js('click',$view->js()->toggle());

		if($form->isSubmitted()){
			$grid->js()->reload(array
									('party_id'=>$form->get('party_id'),
									'from_date'=>$form->get('from_date')?:'0',
									'to_date'=>$form->get('to_date')?:'0',
									'amount_from'=>$form->get('amount_from'),
									'amount_to'=>$form->get('amount_to'),
									'amount_type'=>$form->get('amount_type'),
									'filter'=>1

									)
								)->execute();
		}

		
	}

	function page_receivePayment(){
		$this->api->stickyGET('bill_id');
		$bill=$this->add('Model_Bill')->load($_GET['bill_id']);
		
		if($bill['bill_amount'] == $bill['received_amount']){
			// $this->
		}

	}

	function page_receivedPaymentDetails(){
		$this->api->stickyGET('bill_id');


		$bill = $this->add('Model_Bill');
		$bill->load($_GET['bill_id']);

		$grid = $this->add("Grid");
		if($_GET['delete']){
			$pr=$this->add('Model_PaymentReceived');
			$pr->load($_GET['delete']);
			$pr->delete();
			$grid->js(null,$grid->js()->univ()->successMessage('Deleted'))->reload()->execute();
		}
		$grid->setModel($bill->ref('PaymentReceived'));
		$grid->addFormatter('amount_submitted','grid/inline');
		$grid->addColumn('Confirm','delete');

	}

}