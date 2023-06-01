<?php
require "db.php";
error_reporting(0);

$name = $surname = $email = $password = $passwordAgain = '';

if (!empty($_POST)) {
    if (isset($_POST['fname']) && ($_POST['fname'] != '')) {
        $name = $_POST['fname'];
    }
    if (isset($_POST['lname']) && ($_POST['lname'] != '')) {
        $surname = $_POST['lname'];
    }

    if (isset($_POST['email']) && ($_POST['email'] != '')) {
        $email = 'a';
    }
    if (isset($_POST['password']) && ($_POST['password'] != '')) {
        if (isset($_POST['passwordAgain']) && ($_POST['passwordAgain'] != '')) {
            $password = $_POST['password'];
            $passwordAgain = $_POST['passwordAgain'];
        }
    }
}

$passwordS = 'a';
if ($password == $passwordAgain) {
    $passwordS = md5($_POST['password']);
}



$sqlMail = "SELECT email FROM `user`";
$result = mysqli_query($conn, $sqlMail);
$mails = array();
if (mysqli_num_rows($result) > 0) {
    $mails = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

foreach ($mails as $mail) {
    if ($mail != $email) {
        $email = $_POST['email'];
    } else {
        $email = 'a';
    }
}

$sql = "INSERT INTO user (name, surname, email, password)
VALUES ('$name', '$surname', '$email', '$passwordS')";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5; url=signUp.php">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/carHome.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="icon" type="image/x-icon" href="images/institutional/favicon.png" />
    <title>Sign Up Confirmation | VEHRIDE</title>
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
                if (!empty($name) && !empty($surname) && !empty($email) && !empty($password) && !empty($passwordAgain)) {
                    if ($passwordS != 'a' && $email != 'a') {
                        mysqli_query($conn, $sql); ?>

                        <h2 class="mt-4">
                            <?php
                            echo "Dear" . "&nbsp;" . $name . "&nbsp;" . $surname . "&nbsp;"; ?>your account has been
                            created!
                        </h2>
                        <h5 class="mt-4">You will redirect previous page after 5 second...</h5>

                    <?php } else { ?>
                        <h2>
                            Your account hasn't been created! Please try again.
                        </h2>
                        <h5 class="mt-4">E-mail is unavailable or password doesn't match! </h5>
                        <h5 class="mt-4">You will redirect previous page after 5 second...</h5>
                    <?php }
                } else { ?>
                    <h2>
                        Your account hasn't been created! Please try again without leaving any blank information.
                    </h2>
                    <h5 class="mt-4">You will redirect previous page after 5 second...</h5>
                <?php }
                ?>
            </div>
        </div>
    </div>


    <section>
        <div style="margin:400px"></div>
    </section>

    <?php require "footer.php" ?><!-- Footer -->
</body>

</html>