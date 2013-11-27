<?php

class Form_Registration extends Form{

	var $registration_id=null;

	function init(){
		parent::init();
		$form=$this;
		$form->addClass('stacked');

		$model=$this->add('Model_Registration');
		if($this->registration_id) $model->load($this->registration_id);

		$this->setModel($model);

		// $form->addSeparator( 'atk-row',array("style"=>"border:1px solid red; float: left ") );
		// $form->addComment('(A) Current Address');

		$address_a_title_field = $form->addField('Readonly','address_a','')->set('Address A');
		$address_b_title_field = $form->addField('Readonly','address_b','')->set('Address B');
		$address_a_title_field->addClass('atk-form-field-readonly asd');

		$education_qualification_title_field = $form->addField('Readonly','educational_qualification_title','')->set('Educational Qualification');
		$experience_title_field = $form->addField('Readonly','experience_title','')->set('Experience');
		$compu_qualification_title_field = $form->addField('Readonly','computer_qualification_title','')->set('Computer Qualification');

		$guarantor_1_title_field = $form->addField('Readonly','guarantor_1','')->set('Guarantor 1');
		$guarantor_2_title_field = $form->addField('Readonly','guarantor_2','')->set('Guarantor 2');
		$affidavit_title_field = $form->addField('Readonly','affidavit_title','')->set('AFFIDAVIT');

		$this->add('Order')
			->move($form->addSeparator('atk-row noborder'),'before','name')
			->move($form->addSeparator('atk-row noborder'),'before','father_name')
			->move($form->addSeparator('atk-row noborder'),'before','dob')
			->move($form->addSeparator('atk-row noborder'),'before','h_no_a')
			->move($address_a_title_field,'before','h_no_a')
			->move($address_b_title_field,'before','h_no_a')
 			// ->move($form->addSeparator('atk-row noborder',array('style'=>'clear:both')),'after','occupation')
			// ->move($form->addSeparator( 'atk-row',array("style"=>"border:1px solid red; float: left ") ),'after','occupation')
			->move($form->addSeparator( "atk-row noborder"),'before','h_no_a')
			->move($form->addSeparator( "atk-row noborder"),'before','area_a')
			->move($form->addSeparator( "atk-row noborder"),'before','pin_a')
			->move($form->addSeparator( "atk-row noborder"),'before','police_station_a')
			->move($form->addSeparator( "atk-row noborder"),'before','ph_no_a')
			->move($form->addSeparator( "atk-row noborder"),'before','email')
			->move($form->addSeparator( "atk-row noborder"),'after','email')
			->move($education_qualification_title_field,'before','edu_examination_1')
			->move($form->addSeparator( "atk-row noborder"),'before','edu_examination_1')
			->move($form->addSeparator( "atk-row noborder"),'before','edu_examination_2')
			->move($form->addSeparator( "atk-row noborder"),'before','edu_examination_3')
			->move($form->addSeparator( "atk-row noborder"),'before','experience1')
			->move($experience_title_field,'before','experience1')
			->move($form->addSeparator( "atk-row noborder"),'before','experience1')
			->move($compu_qualification_title_field,'before','comp_examination_1')
			->move($form->addSeparator( "atk-row noborder"),'before','comp_examination_1')
			->move($form->addSeparator( "atk-row noborder"),'before','comp_examination_2')
			->move($form->addSeparator( "atk-row noborder"),'before','comp_examination_3')
			->move($form->addSeparator( "atk-row noborder"),'before','g1name')
			->move($guarantor_1_title_field,'before','g1name')
			->move($guarantor_2_title_field,'before','g1name')
			
			->move($form->addSeparator( "atk-row noborder"),'before','g1name')
			->move($form->addSeparator( "atk-row noborder"),'before','g1father_name')
			->move($form->addSeparator( "atk-row noborder"),'before','g1designation')
			->move($form->addSeparator( "atk-row noborder"),'before','g1address')
			->move($form->addSeparator( "atk-row noborder"),'before','g1guarantor_sig')
			->move($form->addSeparator( "atk-row noborder"),'before','i_we')
			->move($affidavit_title_field,'before','i_we')
			->move($form->addSeparator( "atk-row noborder"),'before','i_we')
			->move($form->addSeparator( "atk-row noborder"),'before','aff_religion')
			->move($form->addSeparator( "atk-row noborder"),'before','aff_occupation')
			// ->move($form->addComment('(A) Current Address'),'before','h_no_a')
			// ->move($form->addSeparator( "span5"),'before','h_no_a')
			// ->move($form->addComment('(B) Current Address'),'before','h_no_b')
			// ->move('h_no_b','after','mobile_no_a')
			->now();
		$this->addSubmit("Registration");
		$this->arrangeLayout();
	}

	function arrangeLayout(){
		$this->getElement('name')->template->set('row_class','span8');
		// $this->getElement('father_name')->template->set('row_class','span8');
		$this->getElement('emp_image_id')->template->set('row_class','span4');
		$this->getElement('dob')->template->set('row_class','span4');
		$this->getElement('occupation')->template->set('row_class','span4');
		$this->getElement('address_a')->template->trySet('row_class','span6');
		$this->getElement('address_b')->template->trySet('row_class','span6');
		$this->getElement('h_no_a')->template->set('row_class','span3');
		$this->getElement('r_no_a')->template->set('row_class','span3');
		$this->getElement('r_no_b')->template->set('row_class','span3');
		$this->getElement('h_no_b')->template->set('row_class','span3');
		$this->getElement('area_a')->template->set('row_class','span3');
		$this->getElement('area_b')->template->set('row_class','span3');
		$this->getElement('city_b')->template->set('row_class','span3');
		$this->getElement('city_a')->template->set('row_class','span3');
		$this->getElement('pin_a')->template->set('row_class','span3');
		$this->getElement('pin_b')->template->set('row_class','span3');
		$this->getElement('distt_a')->template->set('row_class','span3');
		$this->getElement('distt_b')->template->set('row_class','span3');
		$this->getElement('police_station_a')->template->set('row_class','span3');
		$this->getElement('police_station_b')->template->set('row_class','span3');
		$this->getElement('state_a')->template->set('row_class','span3');
		$this->getElement('state_b')->template->set('row_class','span3');
		$this->getElement('ph_no_a')->template->set('row_class','span3');
		$this->getElement('ph_no_b')->template->set('row_class','span3');
		$this->getElement('mobile_no_a')->template->set('row_class','span3');
		$this->getElement('mobile_no_b')->template->set('row_class','span3');
		$this->getElement('edu_examination_1')->template->set('row_class','span2');
		$this->getElement('edu_subject_1')->template->set('row_class','span2');
		$this->getElement('edu_board_university_1')->template->set('row_class','span2');
		$this->getElement('edu_year_1')->template->set('row_class','span2');
		$this->getElement('edu_div_1')->template->set('row_class','span2');
		$this->getElement('edu_remarks_1')->template->set('row_class','span2');
		$this->getElement('edu_examination_2')->template->set('row_class','span2');
		$this->getElement('edu_subject_2')->template->set('row_class','span2');
		$this->getElement('edu_board_university_2')->template->set('row_class','span2');
		$this->getElement('edu_year_2')->template->set('row_class','span2');
		$this->getElement('edu_div_2')->template->set('row_class','span2');
		$this->getElement('edu_remarks_2')->template->set('row_class','span2');
		$this->getElement('edu_examination_3')->template->set('row_class','span2');
		$this->getElement('edu_subject_3')->template->set('row_class','span2');
		$this->getElement('edu_board_university_3')->template->set('row_class','span2');
		$this->getElement('edu_year_3')->template->set('row_class','span2');
		$this->getElement('edu_div_3')->template->set('row_class','span2');
		$this->getElement('edu_remarks_3')->template->set('row_class','span2');
		$this->getElement('experience1')->template->set('row_class','span12');
		$this->getElement('comp_examination_1')->template->set('row_class','span4');
		$this->getElement('comp_institute_name_1')->template->set('row_class','span4');
		$this->getElement('remarks_about_course_1')->template->set('row_class','span4');
		$this->getElement('comp_examination_2')->template->set('row_class','span4');
		$this->getElement('comp_institute_name_2')->template->set('row_class','span4');
		$this->getElement('remarks_about_course_2')->template->set('row_class','span4');
		$this->getElement('comp_examination_3')->template->set('row_class','span4');
		$this->getElement('comp_institute_name_3')->template->set('row_class','span4');
		$this->getElement('remarks_about_course_3')->template->set('row_class','span4');

		$this->getElement('guarantor_1')->template->trySet('row_class','span6');
		$this->getElement('guarantor_2')->template->trySet('row_class','span6');
		$this->getElement('g1name')->template->set('row_class','span6');
		$this->getElement('g2name')->template->set('row_class','span6');
		$this->getElement('g1father_name')->template->set('row_class','span6');
		$this->getElement('g2father_name')->template->set('row_class','span6');
		$this->getElement('g1designation')->template->set('row_class','span6');
		$this->getElement('g2designation')->template->set('row_class','span6');
		$this->getElement('g1address')->template->set('row_class','span6');
		$this->getElement('g2address')->template->set('row_class','span6');
		$this->getElement('g1guarantor_sig')->template->set('row_class','span6');
		$this->getElement('g2guarantor_sig')->template->set('row_class','span6');

		$this->getElement('i_we')->template->set('row_class','span6');
		$this->getElement('aff_father_name')->template->set('row_class','span6');
		$this->getElement('aff_address')->template->set('row_class','span6');
		$this->getElement('aff_religion')->template->set('row_class','span6');
		$this->getElement('aff_occupation')->template->set('row_class','span12');
		$this->getElement('email')->template->set('row_class','span6');
	}

}