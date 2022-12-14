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
$data->id =isset($_GET['id']) ? $_GET['id'] : exit(); //getting param id

$data->get_chat();
if($data->username != null) {
    //create array
    $form_arry = array(
        "id"=> $data-> id,
        "username"=> $data-> username,
        "message"=> $data-> message,
        "account_type"=> $data-> account_type,
        "time_sent"=> $data-> time_sent,
    );

    http_response_code(200);
    echo json_encode($form_arry);

} else {
    http_response_code(404);
    echo json_encode(
        array('message'=> 'err: no chat found ')
    );

}
