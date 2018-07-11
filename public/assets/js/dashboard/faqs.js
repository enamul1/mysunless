MySunLess.Dashboard.Faqs = {};

MySunLess.Dashboard.Faqs.init = function() {
	$('.faqs').addClass('active open');
};

MySunLess.Dashboard.Faqs.index = function() {
	 
};

MySunLess.Dashboard.Faqs.create = function() {
	$('.add-faq').addClass('active');
};

MySunLess.Dashboard.Faqs.getAllFaqs = function() {
	$('.faq-list').addClass('active');
	$('#faq-list').dataTable();
	$('.delete-faq').click(function(e) {
        var id = this.id;
        var form = $('.'+id).serializeArray();
        $.confirm({
            text: "Are you sure you want to delete this FAQ?",
            confirm: function(button) {
                $.ajax({
                    type: "POST",
                    url: "/dashboard/faq/destroy",
                    data: form,
                    success: function (response) {
                        if (response.errors) {
                            var arr = response.errors;
                            $.each(arr, function(index, value)
                            {
                                if (value.length != 0)
                                {
                                    $("#" + index).after('<div class="help-block">' + value + '</div>');
                                }
                            });
                        } else {
                            $("#"+id).hide();
                        }
                    }
                });
            },
            cancel: function(button) {
                // do something
            }
        });
        e.preventDefault();
	});

};

MySunLess.Dashboard.Faqs.editFaq = function() {
	$('#edit-faq').click(function(e){
		$('.help-block').remove();
		$('#success').remove();
    	var form = $('.faq-edit').serializeArray();
    	var id = $("input[name=id]").val();
    	$.ajax({
            type: "POST",
            url: "/dashboard/faq/update/"+id,
            data: form,
            success: function (response) {
            	
            	if (response.errors) {
            		var arr = response.errors;
	            	$.each(arr, function(index, value)
					{
	            		if (value.length != 0)
						{
	            			$("#" + index).after('<div class="help-block">' + value + '</div>');                            
						}
					});
            	} else {
            		$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>You've successfully updated it.</strong></div>").appendTo( ".success" );
            	}        	    	
            }
        });
		e.preventDefault();
	});
};