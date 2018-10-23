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
 
$database = new Database();
$db = $database->getConnection();
 
$note = new Note($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->body) &&
    !empty($data->category)  
){
 
    // set note property values
    $note->body = $data->body;
    $note->category = $data->category;
 
    // create the note
    if($note->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Note was created."));
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
?>