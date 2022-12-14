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
$data->query = isset($_GET['query']) ? $_GET['query'] : exit(); //getting param id

$data->search();
if($data->report_type != null) {
    //create array
    $form_arry = array(
        "report_type"=> $data-> report_type,
        "location"=> $data-> location,
        "report_date"=> $data-> report_date,
        "time_of_report"=> $data-> time_of_report,
        "station"=> $data->station,  
        "description"=> $data->description,  
    );

    http_response_code(200);
    echo json_encode(
        array($form_arry));

} else {
    http_response_code(404);
    echo json_encode(
        array('message'=> 'record not found: get serious')
    );

}
