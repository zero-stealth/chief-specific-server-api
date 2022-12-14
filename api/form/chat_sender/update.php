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
$data = new ChatSender($db);
$form_data = json_decode(file_get_contents("php://input"));

$data->id = $form_data-> id;

$data->username  = $form_data->username;
$data->message  = $form_data->message;
$data->account_type = $form_data->account_type;
$data->time_sent = $form_data->time_sent;

if($data->update_chat()){
    echo json_encode(
        array("message" => "chat's updated"));
} else {
    echo json_encode(
        array("message" => "chat was not updated"));
}