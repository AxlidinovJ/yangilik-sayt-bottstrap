<?php



function ImgagesFind($datas){
    $explode = explode('<img src="',$datas);
    if(isset($explode[1])){
        $explode2 = explode('" />',$explode[1]);
        $images = $explode2[0];
        return $images;
    }else{
        return false;
    }
}



?>