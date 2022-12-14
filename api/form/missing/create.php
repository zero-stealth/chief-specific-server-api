<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../class/form.php';
include_once '../../../config/database.php'; 

$database = new Database;
$db = $database->connect();
$data = new Missing($db);
$form_data = json_decode(file_get_contents("php://input"));
    
$data->first_name  = $form_data-> first_name;
$data->last_name  = $form_data-> last_name;
$data->last_seen  = $form_data-> last_seen;
$data->description  = $form_data-> description;


if($data->create_missing_person()) {
    echo json_encode(
        array("message" => "data created"));
} else {
    echo json_encode(
        array("message" => "data was not created"));
}