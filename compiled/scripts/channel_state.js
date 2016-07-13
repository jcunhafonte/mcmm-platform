function channelUstream() {
    setTimeout(function () {
        var viewerChannel = UstreamEmbed('UstreamIframe');
        viewerChannel.addListener('live', onEmbedEvent);
        viewerChannel.addListener('offline', onEmbedEvent);
        viewerChannel.addListener('playing', onEmbedEvent);
        viewerChannel.addListener('finished', onEmbedEvent);
    }, 500);
}

var onEmbedEvent = function (event, data) {
    switch (event) {
        case "live":
            $('.button-badge').css('display', 'block');
            $('.wrapper-channel-notification').css('display', 'block');
            break;
        case "offline":
            $('.button-badge').css('display', 'none');
            $('.wrapper-channel-notification').css('display', 'none');
            break;
        case "playing":
            $('.button-badge').css('display', 'block');
            $('.wrapper-channel-notification').css('display', 'block');
            break;
        case "finished":
            $('.button-badge').css('display', 'none');
            $('.wrapper-channel-notification').css('display', 'none');
            break;
    }
};

window.onload = channelUstream();
