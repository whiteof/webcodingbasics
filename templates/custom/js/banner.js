jQuery(function($){
    $(window).load(function() {
        function resizeBanner() {
            var aspectRatioImg = $('#banner-bg').width() / $('#banner-bg').height();
            var aspectRatioBar = $('.banner').width() / $('.banner').height();
            if(aspectRatioImg > aspectRatioBar) {
                $('#banner-bg').removeClass().addClass('banner-bg-full-height');
            }else {
                $('#banner-bg').removeClass().addClass('banner-bg-full-width');
            }
            $('.banner .bar').css('margin-top', '-' + $('#banner-bg').height() + 'px');
            
            //match items' height
            var max_height = 0;
            $('.banner-menu-item').removeAttr('style');
            $('.banner-menu-item').each(function(){
                if($(this).height() > max_height) max_height = $(this).height();
            });
            $('.banner-menu-item').height(max_height);
            
        }
        resizeBanner();
        $(window).resize(function() {
            resizeBanner();
        }).trigger("resize");
        $('#banner-bg').fadeIn(200);
        
    });
});
