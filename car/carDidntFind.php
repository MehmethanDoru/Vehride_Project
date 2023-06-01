<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../images/institutional/favicon.png" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/reservationConfirm.css">
    <link rel="stylesheet" href="../css/default.css">
    <title>Car is Exist | VEHRIDE</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        if (window.history && window.history.pushState) {
            $(window).on('popstate', function () {
                window.history.pushState('forward', null, './');
                window.history.forward();
            });
        }
    </script>
</head>

<body>
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

    <div style="margin-top:95px"></div>
    <div class="container" style="ma">
        <div class="row mt-5 pt-2">
            <div class="mt-5"></div>
            <div class="col-12 d-flex justify-content-center">
                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                <lord-icon src="https://cdn.lordicon.com/dqxvvqzi.json" trigger="loop" delay="1000"
                    colors="outline:#121331,primary:#fae6d1,secondary:#545454" style="width:250px;height:250px">
                </lord-icon>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div id="confirmMessage">
                    Sorry!
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div id="confirmMessage">
                    We could not find the vehicle you requested for the dates you searched :(
                </div>
            </div>
            <div class="col-12 mt-3 d-flex justify-content-center">
                <div style="font-weight: bold">
                    You can browse our other <a href="vehiclesCar.php">vehicles</a> or return to the <a href="car.php">home page</a> 
                </div>
            </div>
        </div>
    </div>
    <div style="margin:135px"></div>

    <?php require "footerCar.php" ?><!-- Footer -->
</body>

</html>