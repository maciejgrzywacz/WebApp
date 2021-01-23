<?php
# Round robin web switching
$server_index_file_name = "RR_sever_index";
$servers = ["www.gdansk.pl", "www.sopot.pl", "www.gdynia.pl"];

$server_index = 0;
if (file_exists($server_index_file_name))
    $server_index = file_get_contents($server_index_file_name);

$server_index = ($server_index + 1) % count($servers);
file_put_contents($server_index_file_name, $server_index);
header('Location: http://'.$servers[$server_index]);
?>