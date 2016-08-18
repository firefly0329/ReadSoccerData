<?php

$ch = curl_init();

//取得資料清單：https://leb-firefly0329.c9users.io/GAME/api/list
//取得單筆資料：https://leb-firefly0329.c9users.io/GAME/api/list/4
curl_setopt($ch, CURLOPT_URL, "https://leb-firefly0329.c9users.io/GAME/api/list/4");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'accept: application/json',
    'content-type: application/jason',
    'accept-encoding: gzip, deflate',
    'accept-language: en-US,en;q=0.8',
    'user-agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36'
]);
$pageContent = curl_exec($ch);

curl_close($ch);

echo $pageContent;
// $data = json_decode($pageContent);
// var_dump($data);