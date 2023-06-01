<?php
require "db.php";
$sql = "SELECT * FROM `institutional` ";
$result = mysqli_query($conn, $sql);

$institutional = array();
if (mysqli_num_rows($result) > 0) {
    $institutional = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/contact.css">
     <link rel="icon" type="image/x-icon" href="images/institutional/favicon.png" />
    <title>Contact US | VEHRIDE</title>

    <style>
        .form-control {
            border: none;
            background-color: #e9e7e7;
        }

        .form-control:focus {
            border-color: #e9e7e7;
            box-shadow: none;
            background-color: #e9e7e7;

        }
    </style>
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
            require "navbarUser.php";
        }
        if ($emailExist == 0) {
            require "navbar.php";
        }
        ?>
    </div>
    <!-- NAVBAR END -->

    <div class="container" style="margin-top:95px; margin-bottom: 23px">
        <div class="row">
            <div class="col-md-5 col-sm-12 offset-md-1 contact-left mb-4">
                <div class="leftText">
                    <h3>Let's Chat.</h3>
                    <h3>Tell me about what</h3>
                    <h3>you want.</h3>
                    <p>Let's solve together!<span style="font-size:20px">&#129311;&#127996;</span></p>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 contact-right ">
                <p>Send us a message<span style="font-size:18px">&#128640;</span></p>
                <form action="sendMail.php" method="post">
                    <div class="formSize">
                        <div class="form-floating mt-4 a">
                            <input style="background-color: #e9e7e734;" type="text" class="form-control inputSet"
                                id="fullname" name="fullname" placeholder="Full Name" autocomplete="off" required>
                            <label for="fullname">Full Name *</label>
                        </div>
                        <div class="form-floating a ">
                            <input style="background-color: #e9e7e734;" type="email" class="form-control inputSet"
                                id="email" name="email" required placeholder="name@example.com" autocomplete="off"
                                require>
                            <label for="email">Email address *</label>

                        </div>
                        <div class="form-floating a ">
                            <input style="background-color: #e9e7e734;" type="text" class="form-control inputSet"
                                id="subject" name="subject" placeholder="Subject" autocomplete="off" require>
                            <label for="subject">Subject *</label>
                        </div>
                        <div class="form-floating ab ">
                            <textarea rows="8" cols="50" style="background-color: #e9e7e734;  height: 180px;"
                                type="text" class="form-control inputSet" id="message" name="message"
                                placeholder="Your Message" autocomplete="off" required></textarea>
                            <label for="message">Your Message *</label>
                        </div>
                    </div>

                    <input class="sendBtn" type="submit" value="Send">
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h4>Come US</h4>
            </div>
        </div>
        <div class="row" style="margin-top:13px">
            <div class="col-5 comeusInfo">
                <h6><strong>Headquarters</strong></h6>
                <p>Vehride Transportation Solutions Inc.<br>Vehride</p>
                <div class="address">
                    <?php
                    echo $institutional[0]['address'];
                    ?>
                    <p><strong>T: </strong>
                        <?php echo $institutional[0]['phone_number']; ?>
                    </p>
                    <p style="margin-top: -13px"><strong>P: </strong>
                        <?php echo $institutional[0]['tel_no']; ?>
                    </p>
                    <p style="margin-top: -13px"><strong>Email: </strong>
                        <?php echo $institutional[0]['e_mail']; ?>
                    </p>
                </div>
            </div>
            <div class="col-7">
                <h6><strong>Rezervation Center</strong></h6>
                <div class="address2">
                    <p>You can call our 'Reservation Center' line at
                        <strong>
                            <?php echo $institutional[0]['tel_no']; ?>
                        </strong> or send an e-mail to
                        <strong>
                            <?php echo $institutional[0]['e_mail']; ?>
                        </strong> between <strong>08:00 - 00:00</strong> for special pricing and
                        solutions, as well as rich brand and latest model car rental offers.
                    </p>
                </div>
                <h6><strong>7/24 Emergency Assistance Line</strong></h6>
                <div class="address2">
                    <p>If you have an accident with your vehicle, the vehicle is stolen, malfunctioned, a tire burst
                        or
                        in need of any kind of emergency assistance, you can call your <strong>
                            <?php echo $institutional[0]['hotline']; ?>
                        </strong> number of 'Emergency Assistance' line, which provides service 7/24.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div style="margin:100px"></div>
    </section>

    <?php require "footer.php" ?><!-- Footer -->
</body>

</html>