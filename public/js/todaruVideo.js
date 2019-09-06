
// Youtube API Functions (https://developers.google.com/youtube/iframe_api_reference)
// =============================================

var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

//### Variables
var player;
var playerModal = $('#playerModal');

//### Youtube API
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '390',
        width: '640',
        videoId: 'crXuylf-Udw'
    });
}

//### Modal Controls (http://getbootstrap.com/javascript/#modals)
// Modal when show, begin to play video
playerModal.on('show.bs.modal', function (e) {
    player.playVideo();
});

// Modal when hidden, pause or stop playing video
playerModal.on('hidden.bs.modal', function (e) {
    player.pauseVideo();
    //player.stopVideo();
});

