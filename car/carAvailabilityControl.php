<?php
require '../db.php';

if (!empty($_POST)) {
    session_start();
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $city = $_POST['city'];
    $pickupDate = $_POST["pDate"];
    $dropoffDate = $_POST["dDate"];
    
    $compareDate = new DateTime('2024-01-01');
    $compareDate = $compareDate->format('Y-m-d');
    if ($pickupDate > $compareDate ) {
    echo '<div style="font-size:25px; color:#b0453f">Select a date within 2023</div>
          <div style="font-size:15px; color:#000">After 5 seconds you will be redirected to the home page</div>';
    header("Refresh: 5; url=car.php");
    exit;
    }

    $pickup = new DateTime($pickupDate);
    $dropoff = new DateTime($dropoffDate);
    $dropoff->modify('+1 day');
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($pickup, $interval, $dropoff);
   
   
    $_SESSION['pickupDate'] = $pickupDate;
    $_SESSION['dropoffDate'] = $dropoffDate;
    $_SESSION['brand'] = $brand;
    $_SESSION['model'] = $model;
    $_SESSION['city'] = $city;

    $availability = true;

    $dates = array();
    foreach ($dateRange as $date) {
        $formattedDate = $date->format('Y-m-d');
        $dates[] = $formattedDate;
    }

    $dateList = "'" . implode("','", $dates) . "'";

    $sql = "SELECT * FROM day_of_year WHERE dates IN ($dateList)";
    $result = mysqli_query($conn, $sql);

    // rent column ==> (model_id.city_id)
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

        if ($availability) {
            header("Location: reservation.php");
            exit();
        } else {
            header("Location: carDidntFind.php");
            exit();
        }
    }
} else { ?>
    <div>
        <h3>data could not be accessed!</h3>
    </div>
    <div>
        <h3><a href="car.php">Go to Homepage</a></h3>
    </div>
    <?php
}
?>