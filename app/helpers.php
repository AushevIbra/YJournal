<?php

function getMainImage($arrImages){
    if($arrImages !== null){
        $imgs = json_decode($arrImages);

        return $imgs[0];
    }

    return asset('imgs/placeholder-small.jpg');
}

function clearText($str, $limit = 150){
    return (strlen($str) > $limit)? mb_substr($str, 0, $limit) . "...": $str;
}

function getImages($arrImages){
    if($arrImages !== null){
        $imgs = json_decode($arrImages);
        return $imgs;
    }

    return asset('imgs/placeholder-small.jpg');
}
