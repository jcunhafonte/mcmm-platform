<?php

function getImageVideo($video, $idVideo){
    $ffmpeg = '/usr/bin/ffmpeg';
    $video = "../utilizadores/videos/" . $video;
    $image = "../utilizadores/videos/$idVideo.jpg";
    $interval = 5;
    $size = '700x700';
    
    $cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";
    $return = `$cmd`;
}

function getImageNew($video, $idVideo){
    $ffmpeg = '/usr/bin/ffmpeg';
    $video = "../utilizadores/noticias/" . $video;
    $image = "../utilizadores/noticias/$idVideo.jpg";
    $interval = 5;
    $size = '700x700';

    $cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";
    $return = `$cmd`;
}