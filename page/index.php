<?php
class page_index extends Page {
    function init(){
        parent::init();
        // Start your code here

            
        $this->add('View_Bill',array('number_of_items'=>5));

     //    $bill=$this->add('Model_BillDetail');
     //    $i=1;
     //    foreach ($bill as $junk) {
	    //     $vcard=$this->add('View_Vcard');
     //    	$vcard->template->trySet('rate',$bill['rate']);
     //    	$vcard->template->trySet('qty',$bill['qty']);
     //    	$vcard->template->trySet('i',$i);
     //    	$vcard->js('click',array(
	    //     		$vcard->js()->_selector('.info')->slideUp(),
	    //     		$vcard->js()->_selector("#info_$i")->slideDown()
	    //     		)
     //    		);
     //    	$i++;
     //    }


    	// $vcard->js(true,$vcard->js()->_selector(".info")->hide());

    }
}
