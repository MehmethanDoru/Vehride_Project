<?php
require '../db.php';
if (!empty($_POST)) {
    session_start();
    $randomString = '';
    $pickupDate = $_SESSION['pickupDate'];
    $dropoffDate = $_SESSION['dropoffDate'];
    $brand = $_SESSION['brand'];
    $model = $_SESSION['model'];
    $city = $_SESSION['city'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $gender = $_POST["gender"];
    $identity = $_POST["identity"];
    $license = $_POST["license"];
    $phone = $_POST["phone"];
    $phone2 = $_POST["phone2"];
    $address = $_POST["address"];

    // last control start
    $pickup = new DateTime($pickupDate);
    $dropoff = new DateTime($dropoffDate);
    $dropoff->modify('+1 day');
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($pickup, $interval, $dropoff);

    $availability = true;

    $dates = array();
    foreach ($dateRange as $date) {
        $formattedDate = $date->format('Y-m-d');
        $dates[] = $formattedDate;
    }

    $dateList = "'" . implode("','", $dates) . "'";

    $sql = "SELECT * FROM day_of_year WHERE dates IN ($dateList)";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rent_list = explode(',', $row["rent"]);
            foreach ($rent_list as $rent) {
                if ($rent == "$model.$city") {
                    $availability = false;
                    break;
                }
            }
        }

        if ($availability == false) {
            header("Location: reservationResult.php");
            exit();
        } 
    }
    // last control end

    $prefix = "rez-";
    $randomString = $prefix . substr(uniqid('', true), 0, 9);

    $_SESSION['rezNo'] = $randomString;
    $_SESSION['fullName'] = $fullName;
    
    $sql = "INSERT INTO `car_rent_details` (`unique_id`, `fullName`, `birthday_date`, `identity_number`, `licence_number`, `address`, `phone_number`, `phone_number2`, `email`, `city_id`, `brand_id`, `model_id`, `pickup_date`, `dropoff_date`) VALUES ('$randomString', '$fullName', '$birthday', '$identity', '$license', '$address', '$phone', '$phone2', '$email', '$city', '$brand', '$model', '$pickupDate', '$dropoffDate')";

    $result = mysqli_query($conn, $sql);


    $sql = "UPDATE `day_of_year` SET rent=CONCAT(rent,',$model.$city') WHERE dates BETWEEN '$pickupDate' AND '$dropoffDate'";
    $result = mysqli_query($conn, $sql);

}

header("Location: reservationResult.php");
exit;
?>