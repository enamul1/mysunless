MySunLess.Dashboard.Users = {};

MySunLess.Dashboard.Users.init = function() {
	$('.admins').addClass('active open');
};

MySunLess.Dashboard.Users.index = function() {
};

MySunLess.Dashboard.Users.profile = function() {
	$('#edit-profile').click(function(e){
		$('.help-block').remove();
		$('#success').remove();
    	var form = $('.profile-edit').serializeArray();
    	
		$.ajax({
            type: "POST",
            url: "/user/update-profile",
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
            		$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>User info successfully updated.</strong></div>").appendTo( ".success" );
            		var scrollPosition = $('body').offset().top;
     			    $('html, body').animate({
     			        scrollTop: scrollPosition
     			    }, 3000, 'swing');
            	}     	    	
            }
        });
		e.preventDefault();
	})
	
	$('#change-password').click(function(e) {	
		$('.help-block').remove();
		$('.alert-success').remove();
    	var form = $('.edit-password').serializeArray();
		$.ajax({
            type: "POST",
            url: "/user/change-password",
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
            		if(response.fail==='true') {
            			$("#current_password").after('<div class="help-block">' + 'Your current password does not match' + '</div>');
            		}else if (response.success==='true') {
            			$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>You've successfully changed your password.</strong></div>").appendTo( ".success" );
            			var scrollPosition = $('body').offset().top;
         			    $('html, body').animate({
         			        scrollTop: scrollPosition
         			    }, 3000, 'swing');
            		}          		
            	}         	    	
            }
        });
		e.preventDefault();
	});

    // go to avatar tab
    if ($('.change-avatar').length > 0) {
        $('a[href$="#tab_2-2"]').click();
    }
};

MySunLess.Dashboard.Users.createAdmin = function() {
	$('.add-admin').addClass('active');
};

MySunLess.Dashboard.Users.getAllAdmins = function() {
	$('.admin-list').addClass('active');
	$('#admin-list').dataTable();
	$('.delete-admin').click(function(e) {
        var id = this.id;
        var form = $('.'+id).serializeArray();
        $.confirm({
            text: "Are you sure you want to delete this client?",
            confirm: function(button) {
                $.ajax({
                    type: "POST",
                    url: "/dashboard/admin/destroy",
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

MySunLess.Dashboard.Users.adminProfile = function() {
	$('#edit-profile').click(function(e){
		$('.help-block').remove();
		$('#success').remove();
    	var form = $('.profile-edit').serializeArray();
    	
		$.ajax({
            type: "POST",
            url: "/user/update-profile",
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
            		$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>You've successfully updated admin info.</strong></div>").appendTo( ".success" );
            		var scrollPosition = $('body').offset().top;
     			    $('html, body').animate({
     			        scrollTop: scrollPosition
     			    }, 3000, 'swing');
            	}    	    	
            }
        });
		e.preventDefault();
	})
	
	$('#change-password').click(function(e) {	
		$('.help-block').remove();
		$('#success').remove();
    	var form = $('.edit-password').serializeArray();
    	var id = $("input[name=ID]").val();
		$.ajax({
            type: "POST",
            url: "/admin/change-password/"+id,
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
            		if(response.fail==='true') {
            			$("#current_password").after('<div class="help-block">' + 'Your current password does not match' + '</div>');
            		}else if (response.success==='true') {
            			$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>You've successfully changed admin password.</strong></div>").appendTo( ".success" );
            			var scrollPosition = $('body').offset().top;
         			    $('html, body').animate({
         			        scrollTop: scrollPosition
         			    }, 3000, 'swing');
            		}          		
            	}         	    	
            }
        });
		e.preventDefault();
	})
};

MySunLess.Dashboard.Users.getAllCustomers = function() {
	$('.admins').removeClass('active open');
	$('.customers').addClass('active open');
	$('.customer-list').addClass('active');
	$('#customer-list').dataTable();
	$('.delete-customer').click(function(e) {
        var id = this.id;
        var form = $('.'+id).serializeArray();
        $.confirm({
            text: "Are you sure you want to delete this customer?",
            confirm: function(button) {
                $.ajax({
                    type: "POST",
                    url: "/dashboard/admin/destroy",
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

MySunLess.Dashboard.Users.getCustomer = function() {
	$('.admins').removeClass('active open');
	$('.customers').addClass('active open');
	$('.customer-list').addClass('active');
	$('#edit-profile').click(function(e){
		$('.help-block').remove();
		$('#success').remove();
    	var form = $('.profile-edit').serializeArray(); 	
		$.ajax({
            type: "POST",
            url: "/user/update-profile",
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
            		//$("#success-message").after('<div class="alert alert-success"><a class="close" data-dismiss="alert">'+'×'+'</a><strong>'+'Customer info successfully updated'+'</strong></div>');
            		$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>Customer info successfully updated.</strong></div>").appendTo( ".success" );
            		var scrollPosition = $('body').offset().top;
     			    $('html, body').animate({
     			        scrollTop: scrollPosition
     			    }, 3000, 'swing');
            	}	    	
            }
        });
		e.preventDefault();
	})
	
	$('#change-password').click(function(e) {	
		$('.help-block').remove();
		$('#success').remove();
		var id = $("input[name=ID]").val();
    	var form = $('.edit-password').serializeArray();
		$.ajax({
            type: "POST",
            url: "/admin/change-password/"+id,
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
            		if(response.fail==='true') {
            			$("#current_password").after('<div class="help-block">' + 'Your current password does not match' + '</div>');
            		}else if (response.success==='true') {
            			//$("#success-message").after('<div class="alert alert-success"><a class="close" data-dismiss="alert">'+'×'+'</a><strong>'+'You have successfully changed password'+'</strong></div>');
            			$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>Customer info successfully updated.</strong></div>").appendTo( ".success" );
            			var scrollPosition = $('body').offset().top;
         			    $('html, body').animate({
         			        scrollTop: scrollPosition
         			    }, 3000, 'swing');
            		}          		
            	}         	    	
            }
        });
		e.preventDefault();
	})
};
