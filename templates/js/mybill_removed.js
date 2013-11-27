$.each({
	calculateRow: function(unit_field,rate_field,at_rate_field,amount_field){
		$(amount_field).val($(rate_field).val() * $(unit_field).val()/ $(at_rate_field).val()) ;
	},

	calculateTotal: function(amount_fields, total_field, tax_field, net_field){
		var total=0;
		$.each(amount_fields, function(index, field) {
			 total += ($(field).val()*1);
		});		
		$(total_field).val(total);

		$(net_field).val(
				$(total_field).val()*1 + ((
						$(total_field).val() * $(tax_field).val()/100.00
					)*1)
			);

	}
},$.univ._import)

