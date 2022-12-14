<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../class/user.php';
include_once '../../config/database.php';

$database = new Database();
$db = $database->connect();
$data = new User($db);
$stmt = $data->get_users();
$data_count = $stmt->rowCount();


if ($data_count > 0) {

    $user_arr = array();
    $user_arr["body"] = array();
    $user_arr["data_count"] = $data_count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $d = array(
            'id' => $id,
            'user_name' => $user_name,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'gender' => $gender,
            'date_of_birth' => $date_of_birth,
            'residence' => $residence,
            'phone_no' => $phone_no,
            'id_number' => $id_number,
            'marital_status' => $marital_status,
        );

        array_push($user_arr["body"], $d);
    }

    echo json_encode($user_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array('message' => 'no record found, add record dummy ')
    );
}
