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
$data = new Report($db);
$form_data = json_decode(file_get_contents("php://input"));

$data->id = $form_data-> id;

$data->report_type  = $form_data-> report_type;
$data->location  = $form_data-> location;
$data->station  = $form_data-> station;
$data->description  = $form_data-> description;


if($data->update_report()){
    echo json_encode(
        array("message" => "report updated: how lucky"));
} else {
    echo json_encode(
        array("message" => "err: report update failed"));
}