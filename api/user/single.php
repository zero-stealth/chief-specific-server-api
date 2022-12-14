<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../class/user.php';
include_once '../../config/database.php';

$database = new Database();
$db = $database->connect();
$data = new User($db);
$data->id =isset($_GET['id']) ? $_GET['id'] : exit(); //getting param id

$data->get_user();
if($data->user_name != null) {
    //create array
    $user_arr = array(
        "id"=> $data-> id,
        "user_name"=> $data-> user_name,
        "first_name"=> $data-> first_name,
        "last_name"=> $data-> last_name,
        "email"=> $data-> email,
        "gender"=> $data-> gender,
        "date_of_birth"=> $data->date_of_birth,
        "residence"=> $data->residence,
        "phone_no"=> $data->phone_no,
        "id_number"=> $data->id_number,
        "marital_status" => $data-> marital_status,
    );

    http_response_code(200);
    echo json_encode($user_arr);

} else {
    http_response_code(404);
    echo json_encode(
        array('message'=> 'user not found, maybe you should enroll one')
    );

}
