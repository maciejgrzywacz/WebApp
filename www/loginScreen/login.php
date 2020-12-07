<?php
header("Access-Control-Allow-Origin: *");

// get post data from angular
$postdata = file_get_contents("php://input");

// Set error code. If anything goes wrong we return it.
// status code 500 - server error
http_response_code(500);

if(isset($postdata) && !empty($postdata)) {

    $data = json_decode($postdata);
    $login = $data->login;
    $password = $data->password;

    try {
        $db = new PDO("sqlite:..\..\database\users.db");
        
        $sql = "SELECT password_hash FROM users WHERE Login = :login";
        $res = $db->prepare($sql);
        
        if (!$res) {
            error_log("ERROR preparing DB statment");
            error_log($res->errorInfo());
            return;
        }

        if (!$res->bindValue(":login", $login)) {
            error_log("ERROR binding value to DB statemant");
            error_log($res->errorInfo());
            return;
        }

        if ($res->execute()) {
            $password_hash = $res->fetch(PDO::FETCH_ASSOC)["password_hash"];

            if (password_verify($password, $password_hash)) {
                // recieved password matches user password stored in base.
                // status code 200 - ok
                http_response_code(200);
            }
            else {
                // no such user in database
                // status code 401 - unauthorized
                error_log('passwords do not match');
                http_response_code(401);
            }
        }
        else {
            error_log("ERROR executing DB statement");
            error_log($res->errorInfo());
        }

    } catch(PDOException $e) {
        error_log($e->getMessage());
        http_response_code(401);
    }

}
?> 