MySunLess.Dashboard.Reports = {};

MySunLess.Dashboard.Reports.init = function() {
	$('.reports').addClass('active open');
};

MySunLess.Dashboard.Reports.index = function() {
	 
};

MySunLess.Dashboard.Reports.create = function() {
	$('.add-goal').addClass('active');
    $('#add-goal').click(function(e) {
    	$('.help-block').remove();
    	var form = $('.form-horizontal').serializeArray();
    		$.ajax({
	            type: "POST",
	            url: "/goals/store",
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
	            		$('.form-horizontal')[0].reset();
	            		$("<div class='alert alert-success'><a data-dismiss='alert' class='close'>×</a><strong>You have successfully set up a goal.</strong></div>").prependTo( ".form-horizontal" );
	            	}	    	
	            }
	       });
	    e.preventDefault(); 	
    });
    
    $('#update-goal').click(function(e) {
    	$('.help-block').remove();
    	var form = $('.form-horizontal').serializeArray();
    		$.ajax({
	            type: "POST",
	            url: "/goals/update",
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
	            		$('.form-horizontal')[0].reset();
	            		$("<div class='alert alert-success'><a data-dismiss='alert' class='close'>×</a><strong>You have successfully set up a goal.</strong></div>").prependTo( ".form-horizontal" );
	            	}	    	
	            }
	       });
	    e.preventDefault(); 	
    });
};

MySunLess.Dashboard.Reports.showMonthlyChart = function() {
	$('.monthly-goal').addClass('active');
	$.ajax({
	    url: '/dashboard/monthly-cost',
	    method: 'GET',
	    dataType:"json",
	    success: function (response) {
	         var plot = $.plot($("#chart_2"), [{
	                     data: response,
	                     label: "Income",
	                     lines: {
	                         lineWidth: 1,
	                     },
	                     shadowSize: 0
	
	                 }
	             ], {
	                 series: {
	                     lines: {
	                         show: true,
	                         lineWidth: 2,
	                         fill: true,
	                         fillColor: {
	                             colors: [{
	                                     opacity: 0.05
	                                 }, {
	                                     opacity: 0.01
	                                 }
	                             ]
	                         }
	                     },
	                     points: {
	                         show: true,
	                         radius: 3,
	                         lineWidth: 1
	                     },
	                     shadowSize: 2
	                 },
	                 grid: {
	                     hoverable: true,
	                     clickable: true,
	                     tickColor: "#eee",
	                     borderColor: "#eee",
	                     borderWidth: 1
	                 },
	                 colors: ["#d12610", "#37b7f3", "#52e136"],
	                 xaxis: {
	                     ticks: 11,
	                     tickDecimals: 0,
	                     tickColor: "#eee",
	                 },
	                 yaxis: {
	                     ticks: 11,
	                     tickDecimals: 0,
	                     tickColor: "#eee",
	                 }
	             });
	
	
	         function showTooltip(x, y, contents) {
	             $('<div id="tooltip">' + contents + '</div>').css({
	                     position: 'absolute',
	                     display: 'none',
	                     top: y + 5,
	                     left: x + 15,
	                     border: '1px solid #333',
	                     padding: '4px',
	                     color: '#fff',
	                     'border-radius': '3px',
	                     'background-color': '#333',
	                     opacity: 0.80
	                 }).appendTo("body").fadeIn(200);
	         }
	
	         var previousPoint = null;
	         $("#chart_2").bind("plothover", function (event, pos, item) {
	             $("#x").text(pos.x.toFixed(2));
	             $("#y").text(pos.y.toFixed(2));
	
	             if (item) {
	                 if (previousPoint != item.dataIndex) {
	                     previousPoint = item.dataIndex;
	
	                     $("#tooltip").remove();
	                     var x = Math.round(item.datapoint[0].toFixed(2)),
	                         y = item.datapoint[1].toFixed(2);
	
	                     showTooltip(item.pageX, item.pageY, item.series.label + " on day " + x + " = $" + y);
	                 }
	             } else {
	                 $("#tooltip").remove();
	                 previousPoint = null;
	             }
	         });
	    }
	});
};

MySunLess.Dashboard.Reports.showYearlyChart = function() {
	$('.yearly-goal').addClass('active');
	$.ajax({
	    url: '/dashboard/yearly-cost',
	    method: 'GET',
	    dataType:"json",
	    success: function (response) {
	         var plot = $.plot($("#chart_2"), [{
	                     data: response,
	                     label: "Income",
	                     lines: {
	                         lineWidth: 1,
	                     },
	                     shadowSize: 0
	
	                 }
	             ], {
	                 series: {
	                     lines: {
	                         show: true,
	                         lineWidth: 2,
	                         fill: true,
	                         fillColor: {
	                             colors: [{
	                                     opacity: 0.05
	                                 }, {
	                                     opacity: 0.01
	                                 }
	                             ]
	                         }
	                     },
	                     points: {
	                         show: true,
	                         radius: 3,
	                         lineWidth: 1
	                     },
	                     shadowSize: 2
	                 },
	                 grid: {
	                     hoverable: true,
	                     clickable: true,
	                     tickColor: "#eee",
	                     borderColor: "#eee",
	                     borderWidth: 1
	                 },
	                 colors: ["#d12610", "#37b7f3", "#52e136"],
	                 xaxis: {
	                     ticks: 11,
	                     tickDecimals: 0,
	                     tickColor: "#eee",
	                 },
	                 yaxis: {
	                     ticks: 11,
	                     tickDecimals: 0,
	                     tickColor: "#eee",
	                 }
	             });
	
	
	         function showTooltip(x, y, contents) {
	             $('<div id="tooltip">' + contents + '</div>').css({
	                     position: 'absolute',
	                     display: 'none',
	                     top: y + 5,
	                     left: x + 15,
	                     border: '1px solid #333',
	                     padding: '4px',
	                     color: '#fff',
	                     'border-radius': '3px',
	                     'background-color': '#333',
	                     opacity: 0.80
	                 }).appendTo("body").fadeIn(200);
	         }
	
	         var previousPoint = null;
	         $("#chart_2").bind("plothover", function (event, pos, item) {
	             $("#x").text(pos.x.toFixed(2));
	             $("#y").text(pos.y.toFixed(2));
	
	             if (item) {
	                 if (previousPoint != item.dataIndex) {
	                     previousPoint = item.dataIndex;
	
	                     $("#tooltip").remove();
	                     var x = Math.round(item.datapoint[0].toFixed(2)),
	                         y = item.datapoint[1].toFixed(2);
	
	                     showTooltip(item.pageX, item.pageY, item.series.label + " on month " + x + " = $" + y);
	                 }
	             } else {
	                 $("#tooltip").remove();
	                 previousPoint = null;
	             }
	         });
	    }
	});
};
