<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

// pobranie danych (GET imiona.php?filtr=a)
if(isset($_POST["login"]) && isset($_POST["password_hash"]))
{

    $f = $_GET["filtr"];
    $f = substr(strip_tags($f), 0, 20);
    $f = $f . '%';


    
    $sql = "SELECT * FROM users WHERE login is :Login AND Password_Hash IS :password_hash ";
    $res->bindValue(':f', $f);
    $res->execute();
    while($rec = $res->fetch(PDO::FETCH_ASSOC))
    {
        $result[] = $rec;
    }

    if()

    print(json_encode("status:success"));
}
else
{
    print(json_encode("status:error"))
}

// polaczenie z baza
$db = new PDO("sqlite:users.db");

// przygotowanie polecenia
$sql = "SELECT * FROM users WHERE login LIKE :f ";

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