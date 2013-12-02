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
		$extrarows = 32 - $model->count()->getOne();
		for ($i=1; $i<=$extrarows; $i++)
			$iv->add('View',null,'ExtraRows',array('view/extrarows'));
		parent::setModel($model);
		$this->template->trySet('rupee_in_word',$this->convert_digit_to_words($this->model['net_amount']));
		$this->template->trySet('at_rate',round($this->model['at_rate'],0));
		$this->template->trySet('address',$this->model->ref('party_id')->get('address'));
	}
	
	function defaultTemplate(){
		return array('view/report');
	}
	function no_to_words($no){

    // create an array to fix the number values
    $words = array( '0'=> '' , '1'=> 'one' , '2'=> 'two' , '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fouteen', '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty', '40' => 'fourty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy', '80' => 'eighty', '90' => 'ninty', '100' => 'hundred &', '1000' => 'thousand', '100000' => 'lakh', '10000000' => 'crore' );

    // if number you have entered is zero then return blank
    if ( $no == 0 )
        return ' ';
    else {
        $novalue='';
        $highno=$no;
        $remainno=0;
        $value=100;
        $value1=1000;
        while ( $no>=100 ) {
            if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)( $no/$value );
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }
            if ( array_key_exists( "$highno", $words ) )
            return $words["$highno"]." ".$novalue." ".$this->no_to_words( $remainno );
            else {
                $unit=$highno%10;
                $ten =(int)( $highno/10 )*10;
                return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->no_to_words( $remainno );
            }
        }
   
}
function convert_digit_to_words($no) 
    {
        $r_p= explode(".", $no);
        $amt =  $this->no_to_words($r_p[0]) . " rupees";
        if(count($r_p)>1){
            if(strlen($r_p[1])==1) $r_p[1].="0";
            if(strlen($r_p[1])>2) $r_p[1] = substr($r_p[1], 0,2);
            if($r_p[1] !="00")  $amt .= " and " .$this->no_to_words($r_p[1]) . " paise";
        }

        return $amt;
    }

}