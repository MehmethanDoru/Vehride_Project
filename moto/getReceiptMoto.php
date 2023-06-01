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
    <script src="../js/moto.js"></script>
    <link rel="icon" type="image/x-icon" href="../images/institutional/favicon.png" />

    <title>Get Receipt | VEHRIDE</title>
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
            <div class="col-12 text-center mt-5 ">
                <p style="text-decoration: underline;">Enter your reservation number and email to receipt </p>
            </div>

            <div class="col-12 text-center">
                <form action="" method="post" onsubmit="return getFormData(event);">
                    <input class="rezInput text-center" type="text" name="rezNo" id="rezNo" placeholder="rez-1111bb11a"
                        required><br>
                    <input class="rezInput text-center mt-3" type="email" name="email" id="email"
                        placeholder="example@gmail.com" required><br>
                    <button type="submit" class="searchButton mt-3">Send Receipt</button>
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
                                $("#result").html("<div class='alert alert-danger mt-3 col-lg-8 mx-auto' role='alert' style='color:rgb(123, 6, 6); text-align:center; font-weight: bold;'>" + error + "</div>");
                            } else {
                                var fullName = result.full_name;
                                var city = result.city;
                                var brand = result.brand;
                                var model = result.model;
                                var pickup_date = result.pickup_date;
                                var dropoff_date = result.dropoff_date;

                                var tableHTML = `  <div class="container">
                                                        <div class="row">
                                                                <div class="col-12 text-center alert alert-light mt-3 col-lg-8 mx-auto">
                                                                <img src="../images/icons/sent.gif" alt="Sent" style="display: inline; vertical-align: middle;" />
                                                                <p style="display: inline;">Your receipt has been sent to your email</p>
                                                                </div>
                                                        </div>
                                                    </div>`;
                                $("#result").html(tableHTML);
                            }
                        }
                    });

                    return false;
                }
            </script>

        </div>


        <div style="margin:220px"></div>

        <?php require "footerMoto.php" ?><!-- Footer -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>