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
    
    // instantiate user object
    $user = new User($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // get jwt
    $jwt=isset($data->jwt) ? $data->jwt : "";

    if($jwt){
 
        // if decode succeed, show user details
        try {
     
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));
     
            // set user property values here
        }
        catch (Exception $e){
 
            // set response code
            http_response_code(401);
         
            // show error message
            echo json_encode(array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            ));
        }
    }

    // set user property values
    $user->firstname = $data->firstname;
    $user->lastname = $data->lastname;
    $user->email = $data->email;
    $user->password = $data->password;
    $user->id = $decoded->data->id;
    
    // update the user record
    if($user->update()){

        // regenerate jwt will be here
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
         
         // encode token
         $jwt = JWT::encode($token, $key);
         http_response_code(200);
          
         // response in json format
         echo json_encode(
                 array(
                     "message" => "User was updated.",
                     "jwt" => $jwt
                 )
             );
    }
    else{
        http_response_code(401);
        echo json_encode(array("message" => "Unable to update user."));
    }

?>