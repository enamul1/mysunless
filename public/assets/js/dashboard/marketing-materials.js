MySunLess.Dashboard.MarketingMaterials = {};

MySunLess.Dashboard.MarketingMaterials.init = function() {
	$('.marketing-materials').addClass('active open');
};

MySunLess.Dashboard.MarketingMaterials.index = function() {
	 
};

MySunLess.Dashboard.MarketingMaterials.create = function() {
	$('.add-material').addClass('active');
};

MySunLess.Dashboard.MarketingMaterials.getAllMarketingMaterials = function() {
	$('.material-list').addClass('active');
	$('#material-list').dataTable();
	$('.delete-faq').click(function(e) {
        var id = this.id;
        var form = $('.'+id).serializeArray();
        $.confirm({
            text: "Are you sure you want to delete this Material?",
            confirm: function(button) {
                $.ajax({
                    type: "POST",
                    url: "/dashboard/marketing-material/destroy",
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
