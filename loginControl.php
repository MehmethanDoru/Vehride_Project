<?php
require "db.php";
session_start();
$inputEmail = $_POST['email'];
$inputPassword = md5($_POST['password']);
$_SESSION['emailExist'] = 0;
$sql = "SELECT `email` FROM `user`";
$result = mysqli_query($conn, $sql);

$emails = array();
if (mysqli_num_rows($result) > 0) {
    $emails = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

foreach ($emails as $email) {
    if ($email['email'] == $inputEmail) {
        $sql = "SELECT * FROM user WHERE email = '$inputEmail'";
        $result = mysqli_query($conn, $sql);
        $userInfo = mysqli_fetch_assoc($result);
        if ($inputPassword == $userInfo['password']) {
            $_SESSION['emailExist'] = 1;

            $vehicle = $_COOKIE['vehicle'];
            if ($vehicle == 'car') {
            $_SESSION['emailExist'] = 1;
            header("Location: car/car.php");
                exit();
            }
            if ($vehicle == 'motorcycle') {
            $_SESSION['emailExist'] = 1;
            header("Location: moto/moto.php");
                exit();
            }

        } else {
            header("Location: login.php?error=1");
            exit();
        }
        exit();
    }
}

if ($emailExist == 0) {
    header("Location: login.php?error=1");
    exit();
}
?>