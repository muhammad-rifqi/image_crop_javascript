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
    imagejpeg($im,$dir);
    imagedestroy($im);
    echo json_encode(array("success"=>true));
}else{
    echo json_encode(array("success"=>false));
}

