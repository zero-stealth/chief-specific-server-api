<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../class/user.php';
include_once '../../config/database.php';

$database = new Database;     
$db = $database->connect();
$data = new User($db);
$user_data = json_decode(file_get_contents("php://input"));

$data->id = $user_data-> id;

$data->first_name  = $user_data-> first_name;
$data->last_name  = $user_data-> last_name;
$data->email  = $user_data-> email;
$data->gender = $user_data-> gender;
$data->date_of_birth  = $user_data-> date_of_birth;
$data->residence  = $user_data-> residence;
$data->phone_no  = $user_data-> phone_no;
$data->id_number  = $user_data-> id_number;
$data->marital_status = $user_data-> marital_status;

if($data->update_user()){
    echo json_encode(
        array("message" => "user data updated"));
} else {
    echo json_encode(
        array("message" => "user data not updated"));
}