require(['jquery', 'domReady','badass'],function($){
    $.fn.GlobalUserTrack = function(globalUserTrackerEndpoint, data) {
        $.post(globalUserTrackerEndpoint, data);
    }
});