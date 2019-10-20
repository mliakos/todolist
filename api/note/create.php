<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate note object
include_once '../objects/note.php';

include_once '../config/core.php';
include_once '../libs/BeforeValidException.php';
include_once '../libs/ExpiredException.php';
include_once '../libs/SignatureInvalidException.php';
include_once '../libs/JWT.php';
use \Firebase\JWT\JWT;


 
$database = new Database();
$db = $database->getConnection();


/************** Get Authorization Header from POST Request *****************/
function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}
/************** Get JWT from header *****************/
function getBearerToken() {
$headers = getAuthorizationHeader();
// HEADER: Get the access token from the header
if (!empty($headers)) {
    if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
        return $matches[1];
    }
}
return null;
}

$headers = getAuthorizationHeader();
$jwt = getBearerToken();
 
 
 
// if jwt !empty
if($jwt){
 
    // if decoding succeeds, show user details
    try {
        // decode jwt
        $decoded = JWT::decode($jwt, $key, array('HS256'));
 
        // set response code
        http_response_code(200);
 

        $note = new Note($db);
 
        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        $user_id = $decoded->data->id;

        // make sure data is not empty
        if(
            !empty($data->body) &&
            !empty($user_id)  
        ){
        
            // set note property values
            $note->body = $data->body;
            $note->user_id = $user_id;
        
            // create the note
            if($id = $note->create()){
                
                // set response code - 201 created
                http_response_code(201);
        
                // tell the user
                echo json_encode(array("uid = ".$user_id => "Note was created.", "id" => $id));
            }
        
            // if unable to create the note, tell the user
            else{
        
                // set response code - 503 service unavailable
                http_response_code(503);
        
                
                // tell the user
                echo json_encode(array("message" => "Unable to create note."));
            }
        }
        
        // tell the user data is incomplete
        else{
        
            // set response code - 400 bad request
            http_response_code(400);
        
            // tell the user
            echo json_encode(array("message" => "Unable to create note. Data is incomplete."));
        }
 
    }
 
    // if decoding fails-> jwt==invalid
    catch (Exception $e){
    
        // set response code
        http_response_code(401);
    
        // tell the user access denied  & show error message
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}
 
// error msg if jwt==empty
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user access denied
    echo json_encode(array("message" => "Access denied."));
}
?>
 
