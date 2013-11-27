<?php
class Model_Registration extends Model_Table {
	var $table= "registration";
	function init(){
		parent::init();

		$this->hasOne('TermsCondition','t_and_c_id');
		$this->addField('name')->mandatory('must enter name');
		$this->add("filestore/Field_Image","emp_image_id")->type('image');
		$this->addField('father_name')->mandatory('must enter Father name');
		// $this->addField('image');
		$this->addField('religion');
		$this->addField('dob')->type('date');
		$this->addField('occupation');
		$this->addField('h_no_a')->display(array('form'=>'Address'));
		$this->addField('r_no_a')->display(array('form'=>'Address'));
		$this->addField('h_no_b')->display(array('form'=>'Address'));
		$this->addField('r_no_b')->display(array('form'=>'Address'));
		$this->addField('area_a')->display(array('form'=>'Address'));
		$this->addField('city_a')->display(array('form'=>'Address'));
		$this->addField('area_b')->display(array('form'=>'Address'));
		$this->addField('city_b')->display(array('form'=>'Address'));
		$this->addField('pin_a')->display(array('form'=>'Address'));
		$this->addField('distt_a')->display(array('form'=>'Address'));
		$this->addField('pin_b')->display(array('form'=>'Address'));
		$this->addField('distt_b')->display(array('form'=>'Address'));
		$this->addField('police_station_a')->display(array('form'=>'Address'));
		$this->addField('state_a')->display(array('form'=>'Address'));
		$this->addField('police_station_b')->display(array('form'=>'Address'));
		$this->addField('state_b')->display(array('form'=>'Address'));
		$this->addField('ph_no_a')->display(array('form'=>'Address'));
		$this->addField('mobile_no_a')->display(array('form'=>'Address'));
		$this->addField('ph_no_b')->display(array('form'=>'Address'));
		$this->addField('mobile_no_b')->display(array('form'=>'Address'));
		$this->addField('email');
		$this->addField('edu_examination_1');
		$this->addField('edu_subject_1');
		$this->addField('edu_board_university_1');
		$this->addField('edu_year_1');
		$this->addField('edu_div_1');
		$this->addField('edu_remarks_1');
		$this->addField('edu_examination_2');
		$this->addField('edu_subject_2');
		$this->addField('edu_board_university_2');
		$this->addField('edu_year_2');
		$this->addField('edu_div_2');
		$this->addField('edu_remarks_2');
		$this->addField('edu_examination_3');
		$this->addField('edu_subject_3');
		$this->addField('edu_board_university_3');
		$this->addField('edu_year_3');
		$this->addField('edu_div_3');
		$this->addField('edu_remarks_3');

		$this->addField('experience1');
		$this->addField('experience2');
		$this->addField('experience3');
		$this->addField('designation_for_applied');
		$this->addField('comp_examination_1');
		$this->addField('comp_institute_name_1');
		$this->addField('remarks_about_course_1');
		$this->addField('comp_examination_2');
		$this->addField('comp_institute_name_2');
		$this->addField('remarks_about_course_2');
		$this->addField('comp_examination_3');
		$this->addField('comp_institute_name_3');
		$this->addField('remarks_about_course_3');
		$this->addField('personal_name_with_introduce_concern');
		$this->addField('g1name');
		$this->addField('g2name');
		$this->addField('g1father_name');
		$this->addField('g2father_name');
		$this->addField('g1designation');
		$this->addField('g2designation');
		$this->addField('g1address');
		$this->addField('g2address');
		$this->addField('g1guarantor_sig');
		$this->addField('g2guarantor_sig');
		$this->addField('i_we');
		$this->addField('aff_father_name');
		$this->addField('aff_religion');
		$this->addField('aff_address');
		$this->addField('aff_occupation');
		$this->add("filestore/Field_Image","document1_id")->type('image');
		$this->add("filestore/Field_Image","document2_id")->type('image');

		
		$this->add('dynamic_model/Controller_AutoCreator');



	}
}