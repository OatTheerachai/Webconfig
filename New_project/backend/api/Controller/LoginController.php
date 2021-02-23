<?php
    // required headers
    header("Access-Control-Allow-Origin: http://localhost:8080/New_project/backend/api/");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/connect.php';
    include_once '../Models/User.php';
    include_once '../../config/core.php';

    require '../../libs/vendor/autoload.php';
    use \Firebase\JWT\JWT;

    // get database connection
    $database = new Database();
    $db = $database->connect();
    
    $user = new User($db);

        // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // set product property values
    $user->email = $data->email;
    $email_exists = $user->emailExists();

    if($email_exists && password_verify($data->password, $user->password)){
 
        $token = array(
           "iat" => $issued_at,
           "exp" => $expiration_time,
           "iss" => $issuer,
           "data" => array(
               "id" => $user->id,
               "firstname" => $user->firstname,
               "lastname" => $user->lastname,
               "email" => $user->email
           )
        );

        // set response code
        http_response_code(200);
     
        // generate jwt
        $jwt = JWT::encode($token, $key);
        // echo $jwt;
        echo json_encode(
                array(
                    "message" => "Successful login.",
                    "jwt" => $jwt
                )
            );
     
    }
    // login failed
    else{
    
        // set response code
        http_response_code(401);
    
        // tell the user login failed
        echo json_encode(array("message" => "Login failed."));
    }

?>