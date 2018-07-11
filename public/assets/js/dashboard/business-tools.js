MySunLess.Dashboard.BusinessTools = {};

MySunLess.Dashboard.BusinessTools.init = function() {
    $('.business-tools').addClass('active open');
};

MySunLess.Dashboard.BusinessTools.index = function() {
    $('.business-tools-list').addClass('active');
};

MySunLess.Dashboard.BusinessTools.index = function() {
	$('.business-tools-list').addClass('active');
	$('#business-tool-list').dataTable();
	$('.delete-business-tool').click(function(e) {
        var id = this.id;
        var form = $('.'+id).serializeArray();
        $.confirm({
            text: "Are you sure you want to delete this Business Tool ?",
            confirm: function(button) {
                $.ajax({
                    type: "POST",
                    url: "/dashboard/business/tool/destroy",
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
}

MySunLess.Dashboard.BusinessTools.show = function() {
	$('.business-tools').addClass('active open');
	var businessToolTypeId = $('.business-tool-type').data('businessToolTypeId');
    $('.business-tool-list-' + businessToolTypeId).addClass('active');
	$('#business-tool-list').dataTable();
}