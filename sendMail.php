<?php
require "db.php";
error_reporting(0);

$subject = $_POST['subject'];

$fullName = $email = $message = '';

if (!empty($_POST)) {
    if (isset($_POST['fullname']) && ($_POST['fullname'] != '')) {
        $fullName = $_POST['fullname'];
    }
    if (isset($_POST['message']) && ($_POST['message'] != '')) {
        $message = $_POST['message'];
    }

    if (isset($_POST['email']) && ($_POST['email'] != '')) {
        $email = $_POST['email'];
    }
}

$sql = "INSERT INTO user_messages (name, email, subject, message)
VALUES ('$fullName', '$email', '$subject', '$message')";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="refresh" content="5; url=contact.php">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sendMail.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="icon" type="image/x-icon" href="images/institutional/favicon.png" />
    <title>VEHRIDE</title>
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

    <div class="container" style="margin-top:120px; margin-bottom: 23px">
        <div class="col-8 offset-2">
            <div class="info">
                <?php
                if (!empty($fullName) && !empty($message)) {
                    mysqli_query($conn, $sql);
                    ?>

                    <h2 class="mt-4">
                        <?php
                        echo "Dear" . "&nbsp;&nbsp;" . $fullName . "&nbsp;&nbsp;" ?>Your Message Has Been Sent!
                    </h2>
                    <h5 class="mt-4">You will redirect previous page after 5 second...</h5>
                <?php } else { ?>
                    <h2>
                        Your message hasn't been sent! Please try again without leaving any blank information.
                    </h2>
                    <h5 class="mt-4">You will redirect previous page after 5 second...</h5>
                    <?php
                } ?>
            </div>
        </div>
    </div>


    <section>
        <div style="margin:400px"></div>
    </section>

    <?php require "footer.php" ?><!-- Footer -->
</body>

</html>