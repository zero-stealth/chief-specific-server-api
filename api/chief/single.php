<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../class/chief.php';
include_once '../../config/database.php';

$database = new Database();
$db = $database->connect();
$data = new Chief($db);
$data->id =isset($_GET['id']) ? $_GET['id'] : exit(); //getting param id

$data->get_chief();
if($data->user_name != null) {
    //create array
    $chief_arry = array(
        "id"=> $data-> id,
        "user_name"=> $data-> user_name,
        "first_name"=> $data-> first_name,
        "last_name"=> $data-> last_name,
        "email"=> $data-> email,
        "gender"=> $data-> gender,
        "date_of_birth"=> $data->date_of_birth,
        "phone_no"=> $data->phone_no,
        "service_no"=> $data->service_no,
        "location"=> $data->location,
        "rank"=> $data->rank,
        "about"=> $data->about,
        "date_of_join"=> $data->date_of_join,
        "status_id"=> $data->status_id,
    );

    http_response_code(200);
    echo json_encode($chief_arry);

} else {
    http_response_code(404);
    echo json_encode(
        array('message'=> 'chief not found')
    );

}
