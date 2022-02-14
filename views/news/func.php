<?php


function ImgagesFind($datas){
    $explode = explode('<img src="',$datas);
    $explode2 = explode('" />',$explode[1]);
    $images = $explode2[0];
    return $images;
}



?>