MySunLess.Common.Customers = {};

MySunLess.Common.Customers.init = function() {
	$('.home').removeClass('active');
};

MySunLess.Common.Customers.index = function() {
    
};

MySunLess.Common.Customers.signup = function() {
   
    $('.signup').click(function(e) {
    	$('.help-block').remove();
    	var form = $('.form-horizontal').serializeArray();
    		$.ajax({
	            type: "POST",
	            url: "/customers/store",
	            data: form,
	            success: function (response) {
	            	
	            	if (response.errors) {
	            		var arr = response.errors;
		            	$.each(arr, function(index, value)
						{
		            		if (value.length != 0)
							{
		            			$("#" + index).after('<div class="help-block require">' + value + '</div>');                            
							}
						});
	            	} else {
	            		$('.form-horizontal').remove();
	            		$( "<p class='alert alert-success' id ='success'>Your account successfully created</p>" ).appendTo( ".success" );
	            		window.location.href = document.location.origin+'/success';
	            	}
                    
	            	    	
	            }
	        });
	        e.preventDefault();
    	
    });
    
};