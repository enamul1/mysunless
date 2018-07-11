MySunLess.Dashboard.Videos = {};

MySunLess.Dashboard.Videos.init = function() {
    $('.videos').addClass('active open');
};

MySunLess.Dashboard.Videos.index = function() {
    $('.videos-list').addClass('active');

    $('.delete-video').click(function(e) {
        var id = this.id;
        $.confirm({
            text: "Are you sure you want to delete this video?",
            confirm: function(button) {
                $.ajax({
                    type: "POST",
                    url: "/dashboard/video/delete",
                    data: {id : id},
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

MySunLess.Dashboard.Videos.addVideo = function() {
    $('.add-video').addClass('active');
};


MySunLess.Dashboard.Videos.show = function() {
    $('.training-videos').addClass('active open');

    var videoTypeId = $('.video-type').data('videoTypeId');
    $('.videos-list-' + videoTypeId).addClass('active');

    $("a.watch-videos").click(function() {
        $.fancybox({
            'padding'       : 20,
            'autoScale'     : false,
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            'title'         : this.title,
            'width'         : 680,
            'height'        : 495,
            'href'          : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/') + '&autoplay=1',
            'type'          : 'swf',
            'swf'           : {
                'wmode'        : 'transparent',
                'allowfullscreen'   : 'true'
            }
        });
        return false;
    });

    $("img.watch-videos").click(function () {
        $('a.watch-video-' + $(this).attr('id')).click();
    });


};
