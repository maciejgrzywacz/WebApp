<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

// get post data from angular
$postdata = file_get_contents("php://input");

// Set error code. If anything goes wrong we return it.
// status code 500 - server error
http_response_code(500);

if(isset($postdata) && !empty($postdata)) {
    $data = json_decode($postdata);
    
    $login = $data->login;
    $password = $data->password;
    $name = $data->name;
    $surname = $data->surname;
    $pesel = $data->pesel;
    $age = $data->age;
    $country = $data->country;
    $city = $data->city;
    $address = $data->address;
    $postcode = $data->postcode;

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $db = new PDO("sqlite:..\..\database\users.db");
        if (!$db) {
            error_log("Error opening database");
            return;
        }
        
        $sql = "insert into users(login, password_hash, name, surname, pesel, age, country, city, address, postcode) values(:l, :ph, :n, :s, :pe, :ag, :co, :ci, :ad, :pc);";
        
        $res = $db->prepare($sql);        
        if (!$res) {
            error_log("ERROR preparing DB statment");
            error_log($db->errorCode());
            return;
        }

        $status = true;
        $status = $res->bindValue(":l", $login);
        $status = $res->bindValue(":ph", $password_hash);
        $status = $res->bindValue(":n", $name);
        $status = $res->bindValue(":s", $surname);
        $status = $res->bindValue(":pe", $pesel);
        $status = $res->bindValue(":ag", $age);
        $status = $res->bindValue(":co", $country);
        $status = $res->bindValue(":ci", $city);
        $status = $res->bindValue(":ad", $address);
        $status = $res->bindValue(":pc", $postcode);

        if (!status) {
            error_log("ERROR binding value to DB statemant");
            error_log($res->errorInfo());
            return;
        }

        if ($res->execute()) {
            // successfully added user to database
            // status code 201 - created
            http_response_code(201);
            $response->message = "User added successfully.";
            print(json_encode($response));
        }
        else {
            error_log("ERROR executing DB statement");
            error_log($res->errorCode());
            if ($res->errorCode() == 23000) {
                http_response_code(400);
                $response->message = "User already exists.";
                print(json_encode($response));
                return;
            }
        }
    } catch(PDOException $e) {
        error_log("ERROR adding user to database.");
        error_log($e->getMessage());
    }
}
?>