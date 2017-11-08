<?php

$arr = range(0,1000);

$people = 4;

$length = count( $arr );

$partlength = floor($length/$people);

$arra = [];
$arrb = [];
$arrc = [];
$arrd = [];

foreach ($arr as $key => $val) {
    if($key <= $partlength) {
        $arra[] = $arr[$key];
        }
        elseif( ($partlength+1) <= $key && $key <= $partlength*2  ){
            $arrb[] = $arr[$key];
            }elseif(($partlength*2+1) <= $key && $key <= $partlength*3){
                $arrc[] = $arr[$key];
                }else{
                    $arrd[] = $arr[$key];
                    }
        

}

print_r($arrd);
