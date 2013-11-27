$.each({
  calculateRow: function(unit_field,rate_field,at_rate_field,amount_field){
    $(amount_field).val($(rate_field).val() * $(unit_field).val()/ $(at_rate_field).val()) ;
  },
  calculateTotal: function(amount_fields, total_field){
  	var total=0
  	$.each(amount_fields, function(index, val) {
  		total += ($(val).val()*1);
  	});
  	$(total_field).val(total);
  },
  calculateTax: function(total_field, service_charge_per, service_charge,grand_total_field, tax_field,net_field){
    $(service_charge).val(
        $(total_field).val() * $(service_charge_per).val() / 100.00
      );
    $(grand_total_field).val(
        ($(total_field).val()*1) + ($(service_charge).val()*1)
      );
  	$(net_field).val(($(grand_total_field).val()*1) + (($(tax_field).val() * $(grand_total_field).val() / 100.00))*1);
  },
  calculateNet: function(){

  }
},$.univ._import);
