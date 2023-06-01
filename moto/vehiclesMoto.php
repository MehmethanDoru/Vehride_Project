<?php
require "../db.php";

$sql = "SELECT * FROM `moto_model`";
$result = mysqli_query($conn, $sql);

$models = array();
if (mysqli_num_rows($result) > 0) {
    $models = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="../images/institutional/favicon.png" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/vehiclesCar.css">
    <link rel="stylesheet" href="../css/default.css">
    <script src="../js/car.js"></script>
    <title>Motorcycle Fleet | VEHRIDE</title>
</head>

<body>

    <!-- NAVBAR START -->
    <div class=" fixed-top container" id="navbar">
        <?php
        session_start();
        $emailExist = 0;
        if (isset($_SESSION['emailExist'])) {
            $emailExist = $_SESSION['emailExist'];
        }
        if ($emailExist == 1) {
            require "navbarMotoUser.php";
        }
        if ($emailExist == 0) {
            require "navbarMoto.php";
        }

        ?>
    </div>
    <!-- NAVBAR END -->

    <div class="container" style="margin-top:95px;">
        <div class="row">
            <p style="margin-top:20px;"><strong>You can see our fleet of motorcycles below</strong></p>
        </div>
        <div style="margin:20px"></div>

        <div class="row">
            <?php foreach ($models as $model) { ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card mx-auto mb-4">
                        <img class="img" src="../images/moto/moto_models/<?php echo $model['moto_image'] ?>">
                        <div class="textBox">
                            <p class="text head text-center">
                                <?php
                                $str = $model['moto_image'];
                                $substring = substr($str, 0, strpos($str, "-"));
                                $brand = strtoupper($substring);
                                echo $brand ?>
                                <br>
                                <?php echo $model['model_name'] ?>
                            </p>

                            <span>Daily Price</span>
                            <p class="text price">
                                <?php echo $model['price_daily'] ?>€
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="mt-5 text-center">
            I want to make a <b><a style="color: black" href="reservation.php">reservation</a></b>
        </div>
        <div style="margin:70px"></div>

        <?php require "footerMoto.php" ?><!-- Footer -->

       
</body>

</html>