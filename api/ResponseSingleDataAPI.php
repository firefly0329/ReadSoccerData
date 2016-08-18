<?php

require_once("GetData.php");
require_once("HttpStatusCode.php");

//===============取得資料===============
//跟資料庫要資料
$getDataToAPI = new GetDataToAPI;
$id = $_GET['id'];
$data = $getDataToAPI->getSingleData($id);

//跟Memcached要資料
// $memcached = new Memcached();
// $memcached->addServer("localhost", 11211);
// $data = $memcached->get("data");

if(isset($data)){
    $statusCode = 200;
}else{
    $statusCode = 404;
}

//==============設定HTTPHaeder================
$requestContentType = $_SERVER['HTTP_ACCEPT'];
$HttpStatusCode = new HttpStatusCode;
$HttpStatusCode->setHttpHeaders($requestContentType, $statusCode);

//==============回傳資料================
if(strpos($requestContentType,'application/json') !== false){
	$response = json_encode($data);
	echo $response;
}





