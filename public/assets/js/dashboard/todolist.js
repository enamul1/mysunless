MySunLess.Dashboard.Todolist = {};

MySunLess.Dashboard.Todolist.init = function() {
	$('.todo-list').addClass('active open');
};

MySunLess.Dashboard.Todolist.index = function() {
	$('.todo-list-detail').addClass('active');
	/*$('#todo-submit').click(function(e){
		$('.help-block').remove();
		$('#success').remove();
    	var form = $('.todo-create').serializeArray();
    	
		$.ajax({
            type: "POST",
            url: "/dashboard/todo/store",
            data: form,
            success: function (response) {
            	
            	if (response.errors) {
            		var arr = response.errors;
	            	$.each(arr, function(index, value)
					{ console.log(index);
	            		if (value.length != 0)
						{
	            			$("#" + index).after('<div class="help-block">' + value + '</div>');                            
						}
					});
            	} else { 
            		$("<div class='alert alert-success' id='success'><a class='close' data-dismiss='alert'>×</a><strong>Task added to Todo List.</strong></div>").appendTo( ".custom-success" );
            		var scrollPosition = $('body').offset().top;
     			    $('html, body').animate({
     			        scrollTop: scrollPosition
     			    }, 3000, 'swing');
            	}     	    	
            }
        });
		e.preventDefault();
	})*/
	
	$('.todo-tasklist-item').click(function(e){
		var taskId = $(this).data("task-id");
		var host = $(location).attr('hostname');
		window.location = "http://"+host+"/dashboard/todo/task/"+taskId;
		
	})
};

MySunLess.Dashboard.Todolist.getTaskById = function() {
	$('.todo-tasklist-item').click(function(e){
		var taskId = $(this).data("task-id");
		var host = $(location).attr('hostname');
		window.location = "http://"+host+"/dashboard/todo/task/"+taskId;
		
	})
	
	$('#task-remove').click(function(e){
		var taskId = $(this).data("remove-task-id");
		
		$.confirm({
            text: "Are you sure you want to remove this task?",
            confirm: function(button) {
            	$.ajax({
                    url: "/dashboard/todo/remove/"+taskId,
                    success: function (response) {
                    	var host = $(location).attr('hostname');
                    	window.location = "http://"+host+"/dashboard/todo";     	    	
                    }
                });
            },
            cancel: function(button) {
                // do something
            }
        });
	})
	
	$('#task-completed').click(function(e){
		var taskId = $(this).data("complete-task-id");
		
		$.confirm({
            text: "Are you sure you want to mark this task as complete?",
            confirm: function(button) {
            	$.ajax({
                    url: "/dashboard/todo/complete/"+taskId,
                    success: function (response) {
                    	var host = $(location).attr('hostname');
                    	window.location = "http://"+host+"/dashboard/todo";     	    	
                    }
                });
            },
            cancel: function(button) {
                // do something
            }
        });
	})
};
