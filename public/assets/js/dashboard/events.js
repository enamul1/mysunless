MySunLess.Dashboard.Events = {};

MySunLess.Dashboard.Events.init = function() {
    //active menu
    $('.schedules').addClass('active open');

};

MySunLess.Dashboard.Events.index = function() {
    $('.events').addClass('active');
    MySunLess.Dashboard.showCalender();

};

MySunLess.Dashboard.Events.createEvent = function() {
    $('.add-event').addClass('active');

    ComponentsPickers.init();
    MySunLess.Dashboard.Events.initAutocomplete();

};

MySunLess.Dashboard.Events.initAutocomplete = function() {
    var custom = new Bloodhound({
        datumTokenizer: function(d) { return d.tokens; },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: '/events/get-clients-suggeston?query=%QUERY'
    });

    custom.initialize();

    var initializeTypeHead = function () {
        $('#first_name').typeahead(null, {
            name: 'first_name',
            displayKey: 'first_name',
            source: custom.ttAdapter(),
            hint: true,
            templates: {
                suggestion: Handlebars.compile([
                    '<div class="media">',
                    '<div class="pull-left">',
                    '<div class="media-object">',
                    //'<img src="{{img}}" width="50" height="50"/>',
                    '{{{img}}}',
                    '</div>',
                    '</div>',
                    '<div class="media-body">',
                    '<h4 class="media-heading">{{first_name}}{{{add_new}}}</h4>',
                    '<p>{{first_name}} {{last_name}}</p>',
                    '</div>',
                    '</div>',
                ].join(''))
            }
        });
    };

    initializeTypeHead();

    $(document).on('typeahead:selected', function (event, suggestion, dataset) {
        if (suggestion.newClient) {
            $('#first_name').typeahead('destroy');
            $('.select-existing-client').show();

            //make editable
            $("#last_name").prop("readonly",false);
            $("#phone").prop("readonly",false);
            $("#email").prop("readonly",false);

            //set empty value
            $('#last_name').val(suggestion.last_name);
            $('#phone').val(suggestion.phone);
            $('#email').val(suggestion.email);
            $('#address').val(suggestion.address);
            $('#zip').val(suggestion.zip);
            $('#city').val(suggestion.city);
            $('#state').val(suggestion.state);
            $('.client-id').val(suggestion.id);

        } else {
            $('#last_name').val(suggestion.last_name);
            $('#phone').val(suggestion.phone);
            $('#email').val(suggestion.email);
            $('#address').val(suggestion.address);
            $('#zip').val(suggestion.zip);
            $('#city').val(suggestion.city);
            $('#state').val(suggestion.state);
            $('.client-id').val(suggestion.id);

            //make readonly
            /*$("#last_name").prop("readonly",true);
            $("#phone").prop("readonly",true);
            $("#email").prop("readonly",true);
            $("#address").prop("readonly",true);
            $("#zip").prop("readonly",true);
            $("#city").prop("readonly",true);
            $("#state").prop("readonly",true);*/
        }

    });

    $(document).on('click', '.select-existing-client', function () {
        initializeTypeHead();
        $('.select-existing-client').hide();
    })
};

MySunLess.Dashboard.Events.settings = function() {
    $('.event-settings').addClass('active');
};
