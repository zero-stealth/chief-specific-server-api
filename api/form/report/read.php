<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../../../class/form.php';
include_once '../../../config/database.php';

$database = new Database;
$db = $database->connect();
$data = new Report($db);
$stmt = $data->get_reports();
$form_count = $stmt->rowCount();


if ($form_count > 0) {

    $form_arry = array();
    $form_arry["body"] = array();   
    $form_arry["form_count"] = $form_count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $d = array(
            'id' => $id,
            'report_type' => $report_type,
            'location' => $location,
            'report_date' => $report_date,
            'time_of_report' => $time_of_report,
            'station' => $station,
            'description' => $description,
        );

        array_push($form_arry["body"], $d);
    }

   print_r(json_encode($form_arry));
} else {
    http_response_code(404);
    echo json_encode(
        array('message' => 'no record found, add record dummy ')
    );
}
