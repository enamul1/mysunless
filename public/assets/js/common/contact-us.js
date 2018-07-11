MySunLess.Common.ContactUs = {};

MySunLess.Common.ContactUs.init = function() {
	$('.contact-us').addClass('active');
	$('.home').removeClass('active');
};

MySunLess.Common.ContactUs.index = function() {
    $('#send').click(function(e) {
    	$('.help-block').remove();
    	$('#success').remove();
    	var form = $('.contact-form').serializeArray();
    		$.ajax({
	            type: "POST",
	            url: "/question/process",
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
	            		
	            		$( "<p class='alert alert-success' id ='success'>Your question successfully submitted. Do you have any other question ?</p>" ).appendTo( ".success" );
	            		$('.contact-form')[0].reset();
	            	}
	            }
	        });
	        e.preventDefault();
    });
};