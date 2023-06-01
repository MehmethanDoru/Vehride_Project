<?php
require '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rezNo = $_POST["rezNo"];
}

$sql = "SELECT * FROM `moto_rent_details` WHERE unique_id = '$rezNo'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $fullName = $data[0]['fullName'];
    $brand_id = $data[0]['brand_id'];
    $model_id = $data[0]['model_id'];
    $pickup_date = $data[0]['pickup_date'];
    $dropoff_date = $data[0]['dropoff_date'];
    $city_id = $data[0]['city_id'];

    $sql1 = "SELECT * FROM `places` WHERE id = '$city_id'";
    $result1 = mysqli_query($conn, $sql1);
    $city = array();
    if (mysqli_num_rows($result1) > 0) {
        $city = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    }
    $city = $city[0]['city_name'];

    $sql2 = "SELECT * FROM `moto_brands` WHERE id = '$brand_id'";
    $result2 = mysqli_query($conn, $sql2);
    $brand = array();
    if (mysqli_num_rows($result2) > 0) {
        $brand = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    }
    $brand = $brand[0]['brand_name'];

    $sql3 = "SELECT * FROM `moto_model` WHERE id = '$model_id'";
    $result3 = mysqli_query($conn, $sql3);
    $model = array();
    if (mysqli_num_rows($result3) > 0) {
        $model = mysqli_fetch_all($result3, MYSQLI_ASSOC);
    }
    $model = $model[0]['model_name'];

    $rezInfo = array(
        "full_name" => $fullName,
        "city" => $city,
        "brand" => $brand,
        "model" => $model,
        "pickup_date" => $pickup_date,
        "dropoff_date" => $dropoff_date,
    );

    echo json_encode($rezInfo);
} else {
    $error = array('error' => 'Reservation does not exist!');
    echo json_encode($error);
}
?>