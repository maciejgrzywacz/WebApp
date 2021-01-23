<?php
# Load balanced web switching
function http_ping($address)
{
    $start_time = microtime(true);
    $str = file('http://'.$address);
    return (int) ((microtime(true) - $start_time) * 100000000);
}

$servers = ["www.gdansk.pl", "www.sopot.pl", "www.gdynia.pl"];
$server_loads = array_map("http_ping", $servers);
$rand_value = mt_rand(0, array_sum($server_loads));

$server_index = 0;
for(; $server_index < count($servers); $server_index++)
{
    $rand_value = $rand_value - $server_loads[$server_index];
    if ($rand_value <= 0) break;
}

header('Location: http://'.$servers[$server_index]);
?>