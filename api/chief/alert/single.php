<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../class/chief.php';
include_once '../../../config/database.php';

$database = new Database;
$db = $database->connect();
$data = new Alert($db);
$data->id =isset($_GET['id']) ? $_GET['id'] : exit(); //getting param id

$data->get_alert();
if($data->title != null) {
    //create array
    $form_arry = array(
        'id' =>$data->id,
        'title' => $data->title,
        'alert_type' => $data->alert_type,
        'message' => $data->message,
    );

    http_response_code(200);
    echo json_encode($form_arry);

} else {
    http_response_code(404);
    echo json_encode(
        array('message'=> 'no alert found ')
    );

}
