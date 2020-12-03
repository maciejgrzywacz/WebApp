<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

// pobranie danych (GET imiona.php?filtr=a)
if(isset($_GET["filtr"]))
{
    $f = $_GET["filtr"];
    $f = substr(strip_tags($f), 0, 20);
    $f = $f . '%';
}
else
{
    $f = '%';
}

// polaczenie z baza
$db = new PDO("sqlite:imiona.db");

// przygotowanie polecenia
$sql = "SELECT * FROM imiona WHERE imie LIKE :f ORDER BY pozycja";

// wykonanie polecenia
$res = $db->prepare($sql);

// tu by bylo $res->bindValue(":w1", $w1);
$res->bindValue(':f', $f);
$res->execute();
while($rec = $res->fetch(PDO::FETCH_ASSOC))
{
    $wynik[] = $rec;
}

print(json_encode(array("imiona" => $wynik)));
?>