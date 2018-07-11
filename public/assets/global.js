$(document).ready(function() {
    // our application name space
    MySunLess = {};

    // namespace for home module
    MySunLess.Common = {};
    MySunLess.Dashboard = {};

    function showLoading() {

    }

    function hideLoading() {
        // hide gif here, eg:
        $.isLoading( "hide" );
    }

    // lazy load javascript
    if (typeof jsFile !== 'undefined') {
        $.getScript(jsFile, function() {
            //init method will be called automatically
            MySunLess[MySunLessModule][MySunLessController].init();
            //call method in accordance with controller action
            if (typeof MySunLess[MySunLessModule][MySunLessController][MySunLessAction] !== 'undefined') {
                MySunLess[MySunLessModule][MySunLessController][MySunLessAction]();
            }
        });
    }


    /**
     * Show notification if any
     */
    MySunLess.showNotification = function () {
        $('.notification-message').each(function() {
            var notificationMessage = $(this).data('notificationMessage');
            var notificationType = $(this).data('notificationType');
            switch(notificationType) {
                case 'success':
                    alertify.success(notificationMessage);
                    break;
                case 'error':
                    alertify.error(notificationMessage);
                    break;
                default:
                    alertify.log(notificationMessage);
            }
        });
    };
    MySunLess.showNotification();
    $('.dropdown-toggle').dropdown()

    $.ajaxSetup({
    	  headers: {
            'X-CSRF-Token': $('[name="_token"]').val()
        }
        /*beforeSend:function(){
            NProgress.start();
        },
        complete:function(){
            NProgress.done();
        }*/
    });

    $('.phone').mask('(000) 000-0000');
    
    MySunLess.Dashboard.showCalender = function () {

        var customerId = $('#customer-id').data('customerId');
        $.ajax({
            type: "POST",
            url: "/events/get-all",
            dataType: 'json',
            data: { customerId: customerId, location: "Boston" },
            success: function (response) {
                var eventsArray = [];
                $.each(response.events, function (key, event) {
                    var backgroundColor = false;
                    if (event.isAlreadyPassed) {
                        backgroundColor = Metronic.getBrandColor('grey')
                    } else if (event.isToday) {
                        backgroundColor = Metronic.getBrandColor('green');
                    }

                    var fromTimeInMS = parseInt(event.from_time, 10) * 1000;
                    var toTimeInMS = parseInt(event.to_time, 10) * 1000;
                    var newEvent = {
                        id: event.id,
                        title: event.client_name,
                        start: new Date(fromTimeInMS),
                        end: new Date(toTimeInMS),
                        allDay: false,
                        backgroundColor: backgroundColor,
                        url: 'events/create?id=' + event.id,
                        htmlView: event.htmlView

                    };
                    eventsArray.push(newEvent);

                });
                initCalender(eventsArray);
            }
        });

        var initCalender = function (allEvents) {
            if (!jQuery().fullCalendar) {
                return;
            }

            var h = {};

            if ($('#calendar').width() <= 400) {
                $('#calendar').addClass("mobile");
                h = {
                    left: 'title, prev, next',
                    center: '',
                    right: 'today,month,agendaWeek,agendaDay'
                };
            } else {
                $('#calendar').removeClass("mobile");
                if (Metronic.isRTL()) {
                    h = {
                        right: 'title',
                        center: '',
                        left: 'prev,next,today,month,agendaWeek,agendaDay'
                    };
                } else {
                    h = {
                        left: 'title',
                        center: '',
                        right: 'prev,next,today,month,agendaWeek,agendaDay'
                    };
                }
            }

            $('#calendar').fullCalendar('destroy'); // destroy the calendar
            $('#calendar').fullCalendar({ //re-initialize the calendar
                disableDragging: false,
                header: h,
                //editable: true,
                events: allEvents,
                eventMouseover : function ( event, jsEvent, view) {
                    console.log(view.title);
                },
                eventRender: function(event, element) {
                    element.qtip({
                        content: event.htmlView,
                        style: {
                            classes: 'myCustomClass',
                            def: false,
                            widget: true,
                            width: 500, // Overrides width set by CSS (but no max-width!)
                            height: 200 // Overrides height set by CSS (but no max-height!)
                        }
                    });
                }
            });
        };

    };

    $('.training-videos .dropdown-toggle').click(function() {
        window.location = '/videos'
    });
});
