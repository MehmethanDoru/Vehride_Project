<?php
require 'db.php';

$sql = "SELECT * FROM `help`";
$result = mysqli_query($conn, $sql);

$help_list = array();
if (mysqli_num_rows($result) > 0) {
    $help_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="css/help.css">
    <link rel="icon" type="image/x-icon" href="images/institutional/favicon.png" />
    <title>Help & FAQs | VEHRIDE</title>
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
        <?php foreach ($help_list as $key => $help) { ?>

            <div class="row mt-2">
                <div class="col-9 offset-1">
                    <div class="accordion-item " id="accordionExample">
                        <div class="accordion-item ">
                            <h2 class="accordion-header accoTitle" id="heading<?php echo $key; ?>">
                                <button class="accordion" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse<?php echo $key; ?>" aria-expanded="true"
                                    aria-controls="collapse<?php echo $key; ?>">
                                    <p>
                                        <?php echo $help['title'] ?>
                                    </p>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $key; ?>" class="accordion-collapse collapse"
                                aria-labelledby="headingOne<?php echo $key; ?>"
                                data-bs-parent="#accordionExample<?php echo $key; ?>">
                                <div class="accordion-body">
                                    <p style="margin-top:10px">
                                        <?php echo $help['content'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
    <section>
        <div style="margin:140px"></div>
    </section>

    <?php require "footer.php" ?><!-- Footer -->
</body>

</html>