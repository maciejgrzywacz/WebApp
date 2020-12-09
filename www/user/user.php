<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

// pobranie danych (GET imiona.php?filtr=a)
if (isset($_GET["login"])) {
    $l = $_GET["login"];
}


// polaczenie z baza
$db = new PDO("sqlite:..\..\database\users.db");

// przygotowanie polecenia
$sql = "SELECT * FROM users WHERE Login = :login";

// wykonanie polecenia
$res = $db->prepare($sql);

// tu by bylo $res->bindValue(":w1", $w1);
$res->bindValue(':login', $l);
$res->execute();
while ($rec = $res->fetch(PDO::FETCH_ASSOC)) {
    $result[] = $rec;
}

print(json_encode(array("users" => $result)));
