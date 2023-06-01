<?php
$rezNo = $fullName = '';

session_start();
if (isset($_SESSION['rezNo'])) {
    $rezNo = $_SESSION['rezNo'];
    $fullName = $_SESSION['fullName'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../images/institutional/favicon.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/reservationConfirm.css">
    <link rel="stylesheet" href="../css/default.css">
    <title>Reservation Result | VEHRIDE</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };

    </script>

</head>

<body>
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };

    </script>
    <!-- NAVBAR START -->
    <div class=" fixed-top container" id="navbar">
        <?php
        $emailExist = 0;
        if (isset($_SESSION['emailExist'])) {
            $emailExist = $_SESSION['emailExist'];
        }
        if ($emailExist == 1) {
            require "navbarCarUser.php";
        }
        if ($emailExist == 0) {
            require "navbarCar.php";
        }

        ?>
    </div>
    <!-- NAVBAR END -->
    <div style="margin-top:120px"></div>
    <div class="container">
        <div class="row mt-5 pt-5">
            <?php if (!empty($rezNo)) { ?>
                <div class="col-1 d-md-none d-lg-block"></div>
                <div class="col-4" id="starDiv"><lord-icon id="star" src="https://cdn.lordicon.com/clcopglh.json"
                        trigger="loop" delay="2200"><lord-icon>
                </div>
                <div class="col-6">
                    <div id="confirmMessage">
                        Thank You!<br>
                        Your reservation request has been <br> confirmed.
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-5 pt-5 showCode">
                            <h4>Dear
                                <?php echo $fullName . " "; ?>your reservation confirm code:<br> <strong>
                                    <?php echo $rezNo . " <br><br>";
                                    ?>
                                </strong>
                            </h4>


                        </div>
                        <div class="col-12 mt-5 showCode2">
                            <h5>We use only bank transfer for payment, for now.. --> <a href="../bankAccounts.php">Bank
                                    Accounts</a></h5>

                        </div>
                        <div class="col-2 d-flex justify-content-center">
                            <button style="margin-top:14px" class="loginButton" onclick="window.location.href='car.php'">Go
                                to homepage</button>
                        </div>
                    </div>
                </div>
                <?php session_destroy();
            } else {
                error_reporting(0); ?>
                <div class="mt-5"></div>
                <div class="col-1 d-md-none d-lg-block">
                </div>
                <div class="col-4" id="starDiv">
                    <lord-icon src="https://cdn.lordicon.com/vyukcgvf.json" trigger="loop" delay="2200"
                        style="width:120px;height:120px">>
                    </lord-icon>
                </div>
                <div class="col-6">
                    <div id="confirmMessage">
                        Sorry!<br>
                        Your reservation request has not <br>
                        been confirmed.
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-12 mt-3 d-flex justify-content-center">
                    <div style="font-weight: bold">
                        After 5 seconds you will be redirected to the home page!
                    </div>
                </div>
                <script>
                    setTimeout(function () {
                        window.location.href = "car.php";
                    }, 5000);
                </script>
            <?php } ?>
        </div>
    </div>
    </div>
    <div style="margin:135px"></div>

    <?php require "footerCar.php" ?><!-- Footer -->

    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</body>

</html>