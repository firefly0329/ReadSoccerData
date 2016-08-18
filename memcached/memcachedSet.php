<?php

require_once("GetDataMem.php");
ignore_user_abort();

$delay = 60;
do{
    $getDataMem = new GetDataToMem;
    $data = $getDataMem->getDataList();

    $memcached = new Memcached();
    $memcached->addServer("localhost", 11211);
    $memcached->set("data", json_encode($data));

    sleep($delay);
}while(true);