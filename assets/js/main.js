jQuery(document).ready(function($) {
    var idleTime = 0;
    var hide = true;
    // Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 1000); // 1 seconds

    // Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
        removeScreensaver()      
    });
    $(this).keydown(function (e) {
        idleTime = 0;
        removeScreensaver();
    });

    function removeScreensaver(){
        if (!hide){
            $("#wopo_web_screensaver_window").hide('slow');  
            $('#wopo_web_screensaver').attr('src',"#");
            hide = true;
        }        
    }

    function timerIncrement() {
        idleTime = idleTime + 1;
        if (idleTime > 59) { // 60 seconds
            if (wopo_web_screensaver.is_shortcode != 0){        
                $('#wopo_web_screensaver').attr('src',wopo_web_screensaver.app_url);
                $('#wopo_web_screensaver_window').show('slow');
                hide = false;
            }
        }
    }
});