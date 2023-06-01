<?php
require "../db.php";

$sql = "SELECT * FROM `car_model`";
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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/reservationEdit.css">
    <link rel="stylesheet" href="../css/default.css">
    <script src="../js/car.js"></script>
    <link rel="icon" type="image/x-icon" href="../images/institutional/favicon.png" />

    <title>View and Cancel Reservation | VEHRIDE</title>
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

    <div class="container" style="margin-top:95px;">
        <div class="row">
            <div class="col-12 text-center mt-5 ">
                <p style="text-decoration: underline;">Enter your reservation number to make changes </p>
            </div>

            <div class="col-12 text-center">
                <form action="" method="post" onsubmit="return getFormData(event);">
                    <input class="rezInput text-center" type="text" name="rezNo" id="rezNo" placeholder="rez-1111bb11a">
                    <button type="submit" class="searchButton">Search</button>
                </form>
            </div>

            <div id="result"></div>

            <script>
                function getFormData(event) {
                    event.preventDefault();
                    var rezNo = document.getElementById('rezNo').value;

                    // AJAX isteği
                    $.ajax({
                        type: "POST",
                        url: "rezQuery.php",
                        data: { rezNo: rezNo },
                        success: function (data) {
                            var result = JSON.parse(data);
                            if (result.hasOwnProperty('error')) {
                                var error = result.error;
                                $("#result").html("<div class='alert alert-danger mt-4 col-lg-8 mx-auto' role='alert' style='color:rgb(123, 6, 6); text-align:center; font-weight: bold;'>" + error + "</div>");
                            } else {
                                var fullName = result.full_name;
                                var city = result.city;
                                var brand = result.brand;
                                var model = result.model;
                                var pickup_date = result.pickup_date;
                                var dropoff_date = result.dropoff_date;

                                var tableHTML = `<div class="col-lg-8 mx-auto mt-4 text-center table-responsive">
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
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="container">
    <div class="row">
                                    
        <div class="col-12 text-center mt-3"><button onclick="deleteReservation()">Delete this reservation</button></div>
        <div id="processResult" class="text-center col-12 mt-3" style="color: green"></div>
        <div class="col-12 text-center mt-3"><i>Unfortunately no modify can be made at the moment.<i></div>
    </div>
</div>
                                    `;
                                $("#result").html(tableHTML);
                            }
                        }
                    });

                    return false;
                }
            </script>

        </div>
        <div style="margin:20px"></div>
        <script>
            function deleteReservation() {
                var rezNo = document.getElementById('rezNo').value;
                var answer = confirm("Are you sure you want to delete your reservation?");
                if (answer) {
                    $.ajax({
                        type: "POST",
                        url: "deleteReservation.php",
                        data: { rezNo: rezNo },
                        success: function (response) {
                            var message = JSON.parse(response).message;
                            $("#processResult").html(message);
                        }
                    });
                } else {
                    alert("Reservation deletion operation cancelled!");
                    return false;
                }
            }

        </script>

        <div style="margin:220px"></div>

        <?php require "footerCar.php" ?><!-- Footer -->

     
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>