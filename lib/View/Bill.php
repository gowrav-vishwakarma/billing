<?php
class View_Bill extends View{
	var $number_of_items=null;
	function init() {
		parent::init();

		$this->api->stickyGET('bill_id');

		if ( $this->number_of_items == null )
			throw $this->exception( 'Please specify number_of_items' );

		$this->api->js()->_load( 'bill' );

		
		$bill_model=$this->add('Model_Bill');
		if($_GET['bill_id']){
			$bill_model->load($_GET['bill_id']);
		}

		$form=$this->add( 'Form' );
		$form->addClass( 'stacked' );

		// $cols= $form->add('Columns');
		// $c1=$cols->addColumn(3);
		// $c2=$cols->addColumn(3);
		// $c3=$cols->addColumn(3);
		// $c4=$cols->addColumn(3);
		if($_GET['bill_id'])
			$new_bill_no = $_GET['bill_id'];
		else
			$new_bill_no=$this->add('Model_Bill')->newBillNo();

		$form->addSeparator( 'atk-row noborder' );
		$form->addField( 'line', 'bill_no' )->set($new_bill_no)->setAttr('disabled','true')->template->set( 'row_class', 'span6' );
		$party_field = $form->addField( 'autocomplete/Plus', array( "name"=>'party_name', "model"=>"Party" ) )->validateNotNull();
		$party_field->other_field->template->set( 'row_class', 'span6' );
		$party_field->setModel( 'Party' );
		$party_field->template->set( 'row_class', 'span6' );
		$party_field->set($bill_model['party_id']);

		$form->addSeparator( 'atk-row noborder' );
		$form->addField('DatePicker','date')->set($bill_model['date'])->template->tryset('row_class','span6');
		$form->addField('line','period')->template->tryset('row_class','span6');
		$form->addSeparator( 'atk-row noborder' );
		$form->add('HR');

		if($_GET['bill_id']){
			$bill_details = $bill_model->ref('BillDetail')->getRows();
			// print_r($bill_details);
		}else{
			$bill_details=array();
		}

		$amount_fields=array();
		for ( $i=1;$i<=$this->number_of_items;$i++ ) {
			$sno_label="S No";
			$item_label = "Service";
			$rate_label = "Rate";
			$remark_lable = "Remark";
			$amount_label = "Amount";
			$at_rate_lable= "@";
			$unit_label="Unit";
			$per_unit_label="Per";
			if ( $i!=1 ) {
				$sno_label="";
				$item_label = "";
				$rate_label = "";
				$remark_lable = "";
				$amount_label = "";
				$at_rate_lable="";
				$unit_label="";
				$per_unit_label="";
			}
			$form->addSeparator( 'atk-row noborder' );
			$form->addField( 'Readonly', 's_no_'.$i, $sno_label )->set( $i )->template->set( 'row_class', 'span1' );
			$i_f=$form->addField( 'autocomplete/Basic', 'item_'.$i, $item_label );
			$i_f->setModel( 'Item' );
			$i_f->other_field->template->set( 'row_class', 'span4' );
			$i_f->set($bill_details[$i-1]['item_id']);
			
			$re_f=$form->addField( 'line', 'reamrk_'.$i, $remark_lable );
			$re_f->template->set( 'row_class', 'span2' );
			$re_f->set($bill_details[$i-1]['remarks']);

			$u_f=$form->addField('line','unit_'.$i,$unit_label);
			$u_f->template->set('row_class','span1');
			$u_f->set($bill_details[$i-1]['unit']);
			
			$r_f=$form->addField( 'line', 'rate_'.$i, $rate_label );
			$r_f->template->set( 'row_class', 'span1' );
			$r_f->set($bill_details[$i-1]['rate']);
			
			$at_rate_f=$form->addField( 'line', 'at_rate_'.$i, $at_rate_lable );
			// $per_f->setAttr('placeholder','/day');
			$at_rate_f->template->set( 'row_class', 'span1' );
			$at_rate_f->set($bill_details[$i-1]['at_rate']);

			$per_unit_f=$form->addField( 'line', 'per_unit_'.$i, $per_unit_label );
			$per_unit_f->setAttr('placeholder','Day/Month');
			$per_unit_f->template->set( 'row_class', 'span1' );
			$per_unit_f->set($bill_details[$i-1]['per']);


			$a_f=$form->addField( 'line', 'amount_'.$i, $amount_label );
			$a_f->template->set( 'row_class', 'span1' );
			$a_f->setAttr( 'disabled', 'true' )->addClass('disabled_input');
			$a_f->set($bill_details[$i-1]['amount']);

			$amount_fields[] = $a_f;
		}

		$form->addSeparator( 'atk-row noborder' );
		
		$t_f=$form->addField( 'line', 'total', 'Total Amount' );
		$t_f->setAttr( 'disabled', 'true' );
		$t_f->template->set( 'row_class', 'span2' );
		$t_f->set($bill_model['total_amount']);

		$sc_f=$form->addField('line','service_charge_per','Service Charge in %');
		$sc_f->template->trySet('row_class','span2');
		$sc_f->set($bill_model['service_charge_per']);

		$sc_amt_f=$form->addField('line','service_charge','Service Charge');
		$sc_amt_f->template->trySet('row_class','span2');
		$sc_amt_f->on('keypress keydown',$sc_amt_f->js()->_enclose());
		$sc_amt_f->set($bill_model['service_charge']);

		$gt_f = $form->addField('line','grand_total');
		$gt_f->template->trySet('row_class','span2');
		$gt_f->set($bill_model['grand_total']);


		$tax_f=$form->addField( 'line', 'tax', 'Tax in %');
		$tax_f->template->set( 'row_class', 'span2' );
		$tax_f->set($bill_model['tax']);

		$net_f=$form->addField( 'line', 'net', 'Net Amount' );
		$net_f->setAttr( 'disabled', 'true' );
		$net_f->template->set( 'row_class', 'span2' );
		$net_f->set($bill_model['net_amount']);

		$form->addSubmit( 'Calculate' );

		for ( $i=1;$i<=$this->number_of_items;$i++ ) {

			$r_f=$form->getElement( 'rate_'.$i );
			$u_f=$form->getElement( 'unit_'.$i );
			$at_rate_f=$form->getElement( 'at_rate_'.$i );
			$a_f=$form->getElement( 'amount_'.$i );

			$r_f->js( 'change' )->univ()
			->calculateRow( $u_f, $r_f,$at_rate_f, $a_f )
			->calculateTotal( $amount_fields, $t_f )
			->calculateTax( $t_f, $sc_f, $sc_amt_f,$gt_f, $tax_f, $net_f );
			$u_f->js( 'change' )->univ()
			->calculateRow( $r_f, $u_f,$at_rate_f, $a_f )
			->calculateTotal( $amount_fields, $t_f )
			->calculateTax( $t_f, $sc_f, $sc_amt_f,$gt_f, $tax_f, $net_f );
			$at_rate_f->js( 'change' )->univ()
			->calculateRow( $r_f, $u_f,$at_rate_f, $a_f )
			->calculateTotal( $amount_fields, $t_f )
			->calculateTax( $t_f, $sc_f, $sc_amt_f,$gt_f, $tax_f, $net_f );
		}

		$tax_f->js( 'change' )->univ()
		->calculateTax( $t_f, $sc_f, $sc_amt_f,$gt_f, $tax_f, $net_f );
		$sc_f->js( 'change' )->univ()
		->calculateTax( $t_f, $sc_f, $sc_amt_f,$gt_f, $tax_f, $net_f );

		$amount_view = $this->add( 'View' );
		if ( $_GET['total_amount'] )
			$amount_view->set( $_GET['total_amount'] );


		// ============  FORM SUBMITTED ====================
		if ( $form->isSubmitted() ) {
			// if($form['net']=='NaN' or $form['net']=="" or $form['net']==0)
			// 	$form->displayError('net',"Net Amount is not valid " . $form['net']);
				// throw new Exception("Error Processing Request", 1);
				


			$total_amount=0;
			$error_field=array();

			$bill=$this->add( 'Model_Bill' );
			if($_GET['bill_id']){
				$bill->load($_GET['bill_id']);
				$bill->ref('BillDetail')->deleteAll();
			}
			$bill_detail=$this->add( 'Model_BillDetail' );

			$bill['name']=$new_bill_no;
			$bill['party_id']=$form['party_name'];
			$bill['period']=$form['period'];
			$bill['tax']=$form['tax'];
			$bill['session_id']=$this->add('Model_CurrentSession')->tryLoadAny()->get('id');
			$bill['date']=$form['date'];
			$bill->save();

			for ( $i=1;$i<=$this->number_of_items;$i++ ) {
				if (
					!(
						(
							$form['item_'.$i] !=null and
							$form['rate_'.$i] !=null and
							$form['unit_'.$i] !=null
						) or
						(
							$form['item_'.$i] ==null and
							$form['rate_'.$i] ==null and
							$form['unit	_'.$i] ==null
						)
					)
				) {
					$error_field[] = !$form['item_'.$i]?:'';
					$error_field[] = !$form['rate_'.$i]?:'';
					$error_field[] = !$form['unit_'.$i]?:'';
					$form->displayError( 'item_'.$i, ' Please fill fields ' . implode( " ", $error_field ) );

				}
				
				if ( $form['item_'.$i]=="" ) continue;

				$item_rate=$form->get( 'rate_'.$i );
				$at_rate = $form['at_rate_'.$i];
				$unit=$form->get( 'unit_'.$i );
				$total_amount += ($item_rate/$at_rate) * $unit	;

				$bill_detail['bill_id']=$bill->id;
				$bill_detail['name']=$form['item_'.$i];
				$bill_detail['item_id']=$form['item_'.$i];
				$bill_detail['remarks']=$form['reamrk_'.$i];
				$bill_detail['unit']=$form['unit_'.$i];
				$bill_detail['rate']=$form['rate_'.$i];
				$bill_detail['at_rate']=$form['at_rate_'.$i];
				$bill_detail['per']=$form['per_unit_'.$i];
				$bill_detail['amount']=$item_rate/$at_rate*$unit;
				$bill_detail->saveAndUnload();


			}

			// $total_amount+=$total_amount*$form->get( 'tax' )/100;
			$service_charge_per = $form['service_charge_per'];
			$service_charge=$total_amount*$service_charge_per/100;
			$grand_total=$total_amount+$service_charge;
			$servicetax_per = $form['tax'];
			$service_tax= ($grand_total * $servicetax_per /100.00);
			$net_amount = $grand_total + $service_tax ;

			$bill['total_amount']=$total_amount;
			$bill['service_charge_per']=$form['service_charge_per'];
			$bill['service_charge']=$service_charge;
			$bill['grand_total']=$grand_total;
			$bill['net_amount']=$net_amount;
			$bill->save();

			$this->js( null, $form->js()->reload() )->univ()->newWindow($this->api->url("printbill",array("bill_id"=>$bill->id,'cut_page'=>1)))->execute();

		}

	}
}
