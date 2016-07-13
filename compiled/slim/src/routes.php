<?php

//Geral
$app->get('/', function ($request, $response, $args) {
    return $this->renderer->render($response, 'splash.php', $args);
});

$app->get('/home', function ($request, $response, $args) {
    $stop = 'teste';
    return $this->renderer->render($response, 'splash.php', $args, $stop);
});

$app->get('/stop', function ($request, $response, $args) {
    return $this->renderer->render($response, 'splash.php', $args);
});

$app->get('/validated', function ($request, $response, $args) {
    return $this->renderer->render($response, 'splash.php', $args);
});

$app->get('/blocked', function ($request, $response, $args) {
    return $this->renderer->render($response, 'splash.php', $args);
});

$app->get('/news', function ($request, $response, $args) {
    return $this->renderer->render($response, 'news.php', $args);
});

$app->get('/projects', function ($request, $response, $args) {
    return $this->renderer->render($response, 'projects.php', $args);
});

$app->get('/videos', function ($request, $response, $args) {
    return $this->renderer->render($response, 'videos.php', $args);
});

$app->get('/channel', function ($request, $response, $args) {
    return $this->renderer->render($response, 'channel.php', $args);
});

$app->get('/students', function ($request, $response, $args) {
    return $this->renderer->render($response, 'students.php', $args);
});

$app->get('/contacts', function ($request, $response, $args) {
    return $this->renderer->render($response, 'contacts.php', $args);
});

$app->get('/publications', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publications.php', $args);
});

$app->get('/publish', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publish.php', $args);
});

//Details
$app->get('/video/[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'videos-details.php', $args);
});

$app->get('/new/[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'news-details.php', $args);
});

$app->get('/project/[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'projects-details.php', $args);
});

$app->get('/@[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'profile.php', $args);
});

$app->get('/publish/video', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publish-videos.php', $args);
});

$app->get('/publish/project/normal', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publish-projects-normal.php', $args);
});

$app->get('/publish/project/slider', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publish-projects-slider.php', $args);
});

$app->get('/publish/new/normal', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publish-news-normal.php', $args);
});

$app->get('/publish/new/text', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publish-news-text.php', $args);
});

$app->get('/publish/new/slider', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publish-news-slider.php', $args);
});

$app->get('/publish/new/video', function ($request, $response, $args) {
    return $this->renderer->render($response, 'publish-news-video.php', $args);
});

$app->get('/edit/video/[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'edit-videos.php', $args);
});

$app->get('/edit/project/[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'edit-projects.php', $args);
});

$app->get('/edit/new/[{name}]', function ($request, $response, $args) {
    return $this->renderer->render($response, 'edit-news.php', $args);
});

//SAIR
$app->get('/exit', function ($request, $response, $args) {
    return $this->renderer->render($response, 'exit.php', $args);
});


//$app->notFound(function () {
//    return $this->renderer->render('404.html');
//});
