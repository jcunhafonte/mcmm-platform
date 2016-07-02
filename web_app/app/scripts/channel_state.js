function channel() {
    var viewer = UstreamEmbed('UstreamIframe');

    viewer.addListener('live', onEmbedEvent);
    viewer.addListener('offline', onEmbedEvent);
    viewer.addListener('playing', onEmbedEvent);
    viewer.addListener('finished', onEmbedEvent);
}

var onEmbedEvent = function (event, data) {

    console.log(event);

    switch (event) {
        case "live":
            break;
        case "offline":
            break;
        case "playing":
            break;
        case "finished":
            break;
    }
};

$(document).ready(function () {
    channel();
});