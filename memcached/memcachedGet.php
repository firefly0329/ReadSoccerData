<?php

$memcached = new Memcached();

$memcached->addServer("localhost", 11211);
$data = $memcached->get("data");

echo $data;
