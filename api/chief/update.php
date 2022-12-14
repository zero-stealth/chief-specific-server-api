<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../class/chief.php';
include_once '../../config/database.php';

$database = new Database;     
$db = $database->connect();
$data = new Chief($db);
$chief_data = json_decode(file_get_contents("php://input"));

$data->id = $chief_data-> id;

$data->first_name  = $chief_data-> first_name;
$data->last_name  = $chief_data-> last_name;
$data->email  = $chief_data-> email;
$data->gender = $chief_data-> gender;
$data->date_of_birth  = $chief_data-> date_of_birth;
$data->phone_no  = $chief_data-> phone_no;
$data->service_no = $chief_data-> service_no;
$data->location = $chief_data-> location;
$data->rank = $chief_data-> rank;
$data->about = $chief_data-> about;
$data->date_of_join = $chief_data-> date_of_join;
$data->status_id = $chief_data-> status_id;

if($data->update_chief()){
    echo json_encode(
        array("message" => "chief data updated"));
} else {
    echo json_encode(
        array("message" => "chief data not update"));
}