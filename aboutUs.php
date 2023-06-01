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
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="icon" type="image/x-icon" href="images/institutional/favicon.png" />
    <title>About US | VEHRIDE</title>
</head>
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

<div class="container" style="margin-top:100px; margin-bottom: 89px">

    <div class="row">
        <div class="col-12 brace" style="border: none">
            <h4 class="title mt-5">VEHRIDE</h4>
            <?php
            echo $institutional[0]['about_us'];
            ?>
        </div>
    </div>
</div>

<?php require "footer.php" ?><!-- Footer -->


</body>

</html>