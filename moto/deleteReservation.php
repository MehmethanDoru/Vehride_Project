<?php
require '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $rezNo = $_POST["rezNo"];
    
    $sql = "DELETE FROM `moto_rent_details` WHERE `moto_rent_details`.`unique_id` = '$rezNo';";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $response = array('message' => 'Your reservation was successfully deleted');
        echo json_encode($response);
    } else {
        $response = array('error' => 'An error occurred while deleting your reservation');
        echo json_encode($response);
    }
}
?>