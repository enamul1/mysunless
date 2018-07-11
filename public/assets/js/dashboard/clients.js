MySunLess.Dashboard.Clients = {};

MySunLess.Dashboard.Clients.init = function() {
	$('.clients').addClass('active open');
};

MySunLess.Dashboard.Clients.index = function() {
	 
};

MySunLess.Dashboard.Clients.getAllClients = function() {
	$('.client-list').addClass('active');
	$('#client-list').dataTable();
	
	$('.delete-client').click(function(e) {
        var id = this.id;
        var form = $('.'+id).serializeArray();
        $.confirm({
            text: "Are you sure you want to delete this client?",
            confirm: function(button) {
                $.ajax({
                    type: "POST",
                    url: "/dashboard/client/destroy",
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

MySunLess.Dashboard.Clients.createClient = function() {
	$('.add-client').addClass('active');
}
MySunLess.Dashboard.Clients.getClientDetail = function() {
	$('#material-list').dataTable();
	$('#schedule-history').dataTable();
	$('#edit-profile').click(function(e){
		$('.help-block').remove();
		$('#success').remove();
    	var form = $('.profile-edit').serializeArray();
    	var id = $("input[name=id]").val();
    	$.ajax({
            type: "POST",
            url: "/dashboard/client/update-client/"+id,
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
            		$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>Client info successfully updated.</strong></div>").appendTo( ".success" );
            	}        	    	
            }
        });
		e.preventDefault();
	});
	
	$('#edit-note').click(function(e){
		$('.help-block').remove();
		$('#success').remove();
    	var form = $('.note-edit').serializeArray();
    	var id = $("input[name=id]").val();
    	$.ajax({
            type: "POST",
            url: "/dashboard/client/update-client-note/"+id,
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
            		$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>Client info successfully updated.</strong></div>").appendTo( ".success" );
            	}    	
            }
        });
		e.preventDefault();
	});
	
	$('.delete-client-file').click(function(e) {
        var id = this.id;
        var form = $('.'+id).serializeArray();
        $.confirm({
            text: "Are you sure you want to delete this file?",
            confirm: function(button) {
                $.ajax({
                    type: "POST",
                    url: "/dashboard/client-file/destroy",
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

