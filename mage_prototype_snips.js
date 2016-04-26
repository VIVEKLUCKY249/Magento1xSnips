//Validate by confirmation of fields
/*$('confirm_email').addClassName('validate-custemail');
Validation.addAllThese([
	    ['validate-custemail', 'Please make sure your emails match.', function(v) {
	        var conf = $('confirmation') ? $('confirmation') : $$('.validate-custemail')[0];
	        var pass = false;
	        var confirm;
	        if ($('email')) {
	        	pass = $('email');
	        }
	        confirm =conf.value;
	        if(!confirm && $('confirm_email')) {
	        	confirm = $('confirm_email').value;
	        }
	        return (pass.value == confirm);
	    }],
	]);*/
	
		$('confirm_email').addClassName('validate-cemail');
        Validation.addAllThese([
	    ['validate-cemail', 'Please make sure your emails match.', function(v) {
	        //var conf = $('confirm_email') ? $('confirm_email') : $$('.validate-cemail')[0];
	        var conf = $$('.validate-cemail')[0];
	        var pass = false;
	        var confirm;
	        var emailElements = $$('.validate-email');
	        
	        for (var i = 0; i < emailElements.size(); i++) {
	        	var emailElement = emailElements[i];
	        	if (emailElement.up('form').id == conf.up('form').id) {
	        		pass = emailElement;
	        	}
	        }

	        if ($('email')) {
	        	pass = $('email');
	        }
	        confirm = conf.value;
	        if(!confirm && $('confirm_email')) {
	        	confirm = $('confirm_email').value;
	        }
	        return (pass.value == confirm);
	    }],
	]);
	
	$('confirm_mobile').addClassName('validate-custmobile');
        Validation.addAllThese([
	    ['validate-custmobile', 'Please make sure your mobile numbers match.', function(v) {
	        var conf = $('confirmation') ? $('confirmation') : $$('.validate-custmobile')[0];
	        var pass = false;
	        var confirm;
	        if ($('mobile_number')) {
	        	pass = $('mobile_number');
	        }
	        confirm =conf.value;
	        if(!confirm && $('confirm_mobile')) {
	        	confirm = $('confirm_mobile').value;
	        }
	        return (pass.value == confirm);
	    }],
	]);
