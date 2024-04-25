<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

$data = json_decode(file_get_contents("php://input"),true);
$dir = "upload/".date("dmYHis").".jpeg";
$exp = explode(",",$data['images']);
$convert = base64_decode($exp[1],true);
$im = imagecreatefromstring($convert);
if ($im !== false) {
    header('Content-Type: image/jpeg');
    // $percent = 0.5;
    // $width = imagesx($im);
    // $height = imagesy($im);
    // $newwidth = $width * $percent;
    // $newheight = $height * $percent;
    // $img = imagecreatetruecolor($newwidth,$newheight);
    // imagecopyresized($img,$im,0,0,0,0,$newwidth,$newheight,$width,$height);
    imagejpeg($im,$dir);
    imagedestroy($im);
    echo json_encode(array("success"=>true));
}else{
    echo json_encode(array("success"=>false));
}

