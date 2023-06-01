<?php
require '../db.php';

session_start();
if (!empty($_SESSION['pickupDate'])) {
    $pickupDate = $_SESSION['pickupDate'];
    $dropoffDate = $_SESSION['dropoffDate'];
    $brand = $_SESSION['brand'];
    $model = $_SESSION['model'];
    $city = $_SESSION['city'];

    $pickupUnix = strtotime($pickupDate);
    $dropoffUnix = strtotime($dropoffDate);
    $timeDiff = $dropoffUnix - $pickupUnix;
    $daysDiff = round($timeDiff / (24 * 60 * 60));

    echo $model;
    $sql = "SELECT * FROM `car_model` WHERE id = '$model'";
    $result = mysqli_query($conn, $sql);

    $car = array();
    if (mysqli_num_rows($result) > 0) {
        $car = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    $totalPrice = $car[0]['price_daily'] * $daysDiff;

    $sql = "SELECT `brand_name` FROM `car_brands` WHERE id = '$brand'";
    $result = mysqli_query($conn, $sql);

    $brand = array();
    if (mysqli_num_rows($result) > 0) {
        $brand = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
} else {
    $sql = "SELECT * FROM `car_model`";
    $result = mysqli_query($conn, $sql);

    $carModel = array();
    if (mysqli_num_rows($result) > 0) {
        $carModel = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    $sql = 'SELECT * FROM `places` ORDER BY city_name ASC';
    $result = mysqli_query($conn, $sql);

    $city_list = array();
    if (mysqli_num_rows($result) > 0) {
        $city_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    $city_selected = '';
    if (!empty($_POST)) {
        if (isset($_POST['city']) && is_numeric($_POST['city'])) {
            $city_selected = $_POST['city'];
        }
    }

    $sql = 'SELECT * FROM `car_brands` ORDER BY brand_name ASC';
    $result = mysqli_query($conn, $sql);



    $brand_list = array();
    if (mysqli_num_rows($result) > 0) {
        $brand_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    $brand_selected = '';
    if (!empty($_POST)) {
        if (isset($_POST['brand']) && is_numeric($_POST['brand'])) {
            $brand_selected = $_POST['brand'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/reservationCar.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../dist/mc-calendar.min.css" />
    <!-- <link rel="stylesheet" href="../dist/mc-calendar.min.line.css" /> -->
    <link rel="stylesheet" href="../slick/slick.css">
    <link rel="stylesheet" href="../slick/slick-theme.css">
    <script src="../js/car.js"></script>
    <script src="../dist/mc-calendar.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../images/institutional/favicon.png" />

    <title>Rent a Car | VEHRIDE</title>

    <script type="text/javascript">
        window.onload = function () {
            window.history.forward();
        }
    </script>
    <style>
        .carsShow div {
            text-align: center;
        }

        .carsShow img {
            max-width: 100%;
        }
    </style>
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
    <div style="margin-top:90px"></div>
    <?php if (isset($_SESSION['pickupDate'])) { ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>

        <div class="container">
            <div class="row">
                <div id="choice">
                    <h4>Good choice! Complete the rent with vehride. </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-xs-8" id="carImg">
                    <img src="../images/car/car_models/<?php echo $car[0]['car_image']; ?>"
                        alt="<?php echo $car[0]['model_name'] ?>" width="100%">
                </div>
                <div class="col-lg-5 col-xs-6" id="carInfo">
                    <div class="carInfo">
                        <h5><strong>Brand Name:</strong>
                            <?php echo $brand[0]['brand_name']; ?>
                        </h5><br>
                        <h5><strong>Model Name:</strong>
                            <?php echo $car[0]['model_name']; ?>
                        </h5><br>
                        <h5><strong>Year of Model:</strong>
                            <?php echo $car[0]['model_year']; ?>
                        </h5><br>
                        <h5><strong>Price Daily:</strong>
                            <?php echo $car[0]['price_daily']; ?>&#8364;
                        </h5><br>
                        <h5><strong>Selected Date Range:</strong>
                            <?php echo "'" . $pickupDate . "' <strong><small>and</small></strong> '" . $dropoffDate . "'"; ?>
                        </h5><br>
                    </div>
                </div>
                <div class="col-lg-3  col-xs-6" id="rentInfo">
                    <div class="rentInfo">
                        <h6>Total Number of Days: <strong>
                                <?php echo $daysDiff; ?>
                            </strong><br>Total Price: <strong>
                                <?php echo $totalPrice; ?>&#8364;
                            </strong></h6>
                    </div>
                    <div class="acceptRent">
                        <button id="openStep2">Accept & Next</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4 mb-5" id="step2" style="display:none;">
            <div class="row">
                <form action="reservationConfirm.php" method="post">
                    <div class="col-12 step2Form">
                        <div class="row">
                            <div class="col-6">
                                <div class="fullName">
                                    <label for="fullName">fullname</label>
                                    <input name="fullName" style="background-color: #c2c2c2;" type="text"
                                        class="form-control " id="fullName" required autocomplete="off">
                                </div>
                                <div class="email">
                                    <label for="email">email</label>
                                    <input name="email" style="background-color: #c2c2c2;" type="email" class="form-control"
                                        id="email" autocomplete="off" required>
                                </div>
                                <div class="birthday">
                                    <label for="birthday">birthday</label>
                                    <input name="birthday" style="background-color: #c2c2c2;" type="text"
                                        class="form-control" id="birthday21" autocomplete="off" required>
                                </div>
                                <div class="gender">
                                    <label for="gender">gender</label>
                                    <select name="gender" id="gender" class="form-control"
                                        style="background-color: #c2c2c2;" required>
                                        <option value="man">Man</option>
                                        <option value="woman">Woman</option>
                                        <option value="other">Other</option>
                                        <option value="notPrefer">I don't want to prefer
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="identity">
                                    <label for="identity">identity number (11)</label>
                                    <input name="identity" style="background-color: #c2c2c2;" type="text"
                                        class="form-control" id="identity" autocomplete="off" maxlength="11" minlength="11"
                                        required>
                                </div>
                                <div class="license">
                                    <label for="license">license number</label>
                                    <input name="license" style="background-color: #c2c2c2;" type="text"
                                        class="form-control" id="license" autocomplete="off" maxlength="11" minlength="6"
                                        placeholder="S-" required>
                                </div>
                                <div class="phone">
                                    <label for="phone">phone number</label>
                                    <input name="phone" style="background-color: #c2c2c2;" type="text" class="form-control"
                                        id="phone" autocomplete="off" placeholder="+" required>
                                </div>
                                <div class="phone2">
                                    <label for="phone2">phone number 2</label>
                                    <input name="phone2" style="background-color: #c2c2c2;" type="text" class="form-control"
                                        id="phone2" autocomplete="off" placeholder="+" required>
                                </div>
                            </div>
                            <div class="address">
                                <label for="address">address</label>
                                <textarea name="address" style="background-color: #c2c2c2;" rows="3" cols="20" wrap="soft"
                                    class="form-control" id="address" autocomplete="off" required minlength="20"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="btnConfirmDiv"><button type="submit" class="" id="rezConfirm">Rezervation Confirm</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mx-auto mt-3 text-center">
                <a href="deleteSes.php">I gave up. I will choose a new vehicle</a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>

    <?php } else { ?>
        <div class="carsShow">
            <?php foreach ($carModel as $carsModel) {
                echo "<div id='model'><img height='150' width='270' src='../images/car/car_models/$carsModel[car_image]'></div>";
            } ?>
        </div>
        <div class="container">
            <div class="row">
                <h5 class='mt-3' style="text-align: center">Enter your rezervation number for to query</h5>
                <div class="rezQuery">
                    <input type="text" id="rezQuery" name="rezNo" placeholder="rez-123456789">
                    <input class="ms-2" type="submit" onclick="getRezNo();" value="Get Info">
                </div>
                <div id="result" class="mb-3">
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            function getRezNo() {
                var rezNo = document.getElementById('rezQuery').value;
                $.ajax({
                    type: "POST",
                    url: "rezQuery.php",
                    data: { rezNo: rezNo },
                    success: function (data) {
                        var result = JSON.parse(data);
                        if (result.hasOwnProperty('error')) {
                            var error = result.error;
                            $("#result").html("<div class='alert alert-danger mt-4 col-lg-8 mx-auto'  role='alert' style='color:rgb(123, 6, 6); text-align:center; font-weight: bold;'>" + error + "</div>");
                        } else {
                            var fullName = result.full_name;
                            var city = result.city;
                            var brand = result.brand;
                            var model = result.model;
                            var pickup_date = result.pickup_date;
                            var dropoff_date = result.dropoff_date;
                            $("#result").html(`<div class="col-lg-8 mx-auto mt-4 text-center table-responsive">
                                                                <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                    <th scope="col">Fullname</th>
                                                                    <th scope="col">City</th>
                                                                    <th scope="col">Brand</th>
                                                                    <th scope="col">Model</th>
                                                                    <th scope="col">Pickup</th>
                                                                    <th scope="col">Dropoff</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                    <td>${fullName}</td>
                                                                    <td>${city}</td>
                                                                    <td>${brand}</td>
                                                                    <td>${model}</td>
                                                                    <td>${pickup_date}</td>
                                                                    <td>${dropoff_date}</td>
                                                                    </tr>
                                                                </div>`);
                        }
                    }
                });
            }
        </script>
        <div class="container ">
            <div class="row mx-auto">
                <div class="col-md-5 mb-5 mt-4 d-md-block leftPanel">
                    <h2>Choose the most suitable vehicle for you &nbsp;<span style='font-size:25px;'>&#128273;
                            &#x1F697;</span></h2>
                </div>
                <div class="col-sm-8 offset-sm-2 offset-md-1 col-md-6 short-rental mt-5">
                    <div class="formCenter py-3">
                        <form id="brandForm" method="post" action="carAvailabilityControl.php">
                            <div class="city-container">
                                <div class="city">
                                    <label for="city">Choose a pickup city:</label><br>
                                    <select name="city" id="city">
                                        <?php

                                        foreach ($city_list as $city) {
                                            if ($city_selected == $city['id']) {
                                                echo "<option value='" . $city['id'] . "' selected>" . $city['city_name'] . "</option>";

                                            } else {
                                                echo "<option value='" . $city['id'] . "'>" . $city['city_name'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="date-container">
                                <div class="date">
                                    <label for="pDate" style="margin-right:15px">Pickup date:</label><br>
                                    <input id="pDate" name="pDate" style="margin-right:15px" onselect="handleChange()"
                                        type="text" required onclick="inputDisable1()" autocomplete="off">
                                </div>
                                <div class="date">
                                    <label for="dDate">Dropoff date:</label><br>
                                    <input name="dDate" id="dDate" type="text" onclick="inputDisable2()" required
                                        autocomplete="off">
                                </div>
                                <script>
                                    setInterval(() => {
                                        const value = document.getElementById("dDate").value;
                                        if (value !== '') {
                                            brandUndisable(value);
                                        }

                                        if (document.getElementById("pDate").value !== '') {
                                            document.getElementById("pDate").disabled = false;
                                            document.getElementById("dDate").disabled = false;
                                        }

                                        if (document.getElementById("dDate").value !== '') {
                                            document.getElementById("dDate").disabled = false;
                                        }

                                    }, 100);

                                    function brandUndisable(value) {
                                        document.getElementById('brand').disabled = false;
                                    }

                                    function inputDisable1() {
                                        document.getElementById("pDate").disabled = true;
                                    }
                                    function inputDisable2() {
                                        document.getElementById("dDate").disabled = true;
                                    }

                                </script>
                            </div>
                            <div class="brand-model">
                                <div class="brand-container">
                                    <div class="brand">
                                        <label for="brand">Brand of Car:</label><br>
                                        <select name="brand" id="brand" disabled onchange="updateSecondSelect()" required>
                                            <option></option>
                                            <?php

                                            foreach ($brand_list as $brand) {
                                                if ($brand_selected == $brand['id']) {
                                                    echo "<option value='" . $brand['id'] . "' selected>" . $brand['brand_name'] . "</option>";

                                                } else {
                                                    echo "<option value='" . $brand['id'] . "'>" . $brand['brand_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="model-container">
                                    <div class="model">
                                        <label for="model">Model:</label><br>
                                        <select name="model" id="model">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="btn-container mb-2 pb-2">
                                <button type="submit" class="btnShort" name="brandForm">Search Car</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    setInterval(() => {
                        const value = document.getElementById("pDate").value;
                        if (value !== '') {
                            handleChange(value);
                        }
                    }, 300);

                    function handleChange(value) {
                        const startDate = new Date(value);
                        startDate.setDate(startDate.getDate() + 1)
                        const temp = new Date(startDate);
                        temp.setDate(temp.getDate() + 21);
                        const endDate = new Date(temp);
                        const myDatePicker2 = MCDatepicker.create({
                            el: '#dDate',
                            showCalendarDisplay: false,
                            dateFormat: 'YYYY-MM-DD',
                            minDate: startDate,
                            maxDate: endDate,
                        });
                    }
                </script>
                <script>

                    var today = new Date();
                    const myDatePicker1 = MCDatepicker.create({
                        el: '#pDate',
                        showCalendarDisplay: false,
                        dateFormat: 'YYYY-MM-DD',
                        minDate: today,

                    });

                    document.getElementById("mc-btn__cancel").style.display = "none";
                    var button = document.getElementById("mc-btn__ok");

                    setInterval(() => {
                        var cells = document.querySelectorAll(".mc-table__body td");
                        for (var i = 0; i < cells.length; i++) {
                            if (cells[i].classList.contains("mc-date--picked")) {
                                button.disabled = false;
                                break;
                            }
                            else {
                                button.disabled = true;
                            }
                        }
                    }, 100);

                </script>
            </div>
        </div>
    <?php } ?>
    <script src="../js/reservation.js"></script>

    <div style="margin:50px"></div>
    <?php require "footerCar.php" ?><!-- Footer -->


    <script src="../dist/mc-calendar.min.js"></script>

    <script>
        var lastDate = new Date();
        lastDate.setFullYear(lastDate.getFullYear() - 21);
        const myDatePicker1 = MCDatepicker.create({
            el: '#birthday21',
            showCalendarDisplay: false,
            dateFormat: 'YYYY-MM-DD',
            maxDate: lastDate,
            bodyType: 'inline',
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../slick/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.carsShow').slick({
                dots: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: false,
                speed: 350,
                slidesToShow: 4,
                slidesToScroll: 3,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>