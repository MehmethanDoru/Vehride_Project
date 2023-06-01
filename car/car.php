<?php
require "../db.php";
session_start();

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
  <link rel="stylesheet" href="../css/carHome.css">
  <link rel="stylesheet" href="../dist/mc-calendar.min.css" />
  <link rel="stylesheet" href="../css/default.css">
  <link rel="stylesheet" href="../css/uikit.min.css" />
  <script src="../js/car.js"></script>
  <script src="../dist/mc-calendar.min.js"></script>
<link rel="icon" type="image/x-icon" href="../images/institutional/favicon.png" />
  <title>Rent a Car | VEHRIDE</title>
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

  <header id="topOfPage" style="height: 38px">a</header>
  <div class="p-4 p-md-5 mb-5 rounded text-bg-dark bgc-home" style="position: relative; margin-top:55px">
    <div class="col-md-6 py-4 bgc">
      <h1 class="display-4 fst-italic">Rent safely and quickly thanks to VEHRIDE</h1>
      <p class="lead my-3">Everything is online, everything is easy! To feel FREE...</p>
    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-sm-8 offset-sm-2 offset-md-0 col-md-6 short-rental">
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
                <input id="pDate" name="pDate" style="margin-right:15px" onselect="handleChange()" type="text" required
                  onclick="inputDisable1()" autocomplete="off">
              </div>
              <div class="date">
                <label for="dDate">Dropoff date:</label><br>
                <input name="dDate" id="dDate" type="text" onclick="inputDisable2()" required autocomplete="off">
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
      <div class="col-md-5 mt-sm-1 d-md-block rightPanel">
        <h2>Please <a href="../contact.php">contact us</a> if you want to rent more than 21 days.</h2>
      </div>
    </div>
  </div>

  <div class="about mt-4 ">
    <?php $sql = "SELECT * FROM `institutional` ";
    $result = mysqli_query($conn, $sql);

    $institutional = array();
    if (mysqli_num_rows($result) > 0) {
      $institutional = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } ?>
    <div class="ms-4 me-3">
      <h4 class="title mt-3"><strong>VEHRIDE</strong></h4>
      <div class="mb-3">
        <?php
        echo $institutional[0]['about_us'];
        ?>
      </div>
    </div>
  </div>


  <div class="container mt-5">
    <div class="row customer ,mx-auto">
      <div class="col-lg-4">
        <div class="review-card">
          <img src="../images/person/person.jpg" alt="Reviewer Name" class="reviewer-image mb-2">
          <h3 class="reviewer-name">Amelia Jones</h3>
          <p class="review-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae sem nec nisi
            molestie
            feugiat vel quis arcu. Praesent quis posuere quam. Maecenas eu lectus consequat, dapibus odio id, maximus
            sem.
            Nam tincidunt justo ex, at rhoncus dolor sollicitudin ac."</p>
          <span class="review-date">Reviewed on May 1st, 2023</span>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="review-card">
          <img src="../images/person/person2.jpg" alt="Reviewer Name" class="reviewer-image mb-2">
          <h3 class="reviewer-name">George Davis</h3>
          <p class="review-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae sem nec nisi
            molestie
            feugiat vel quis arcu. Praesent quis posuere quam. Maecenas eu lectus consequat, dapibus odio id, maximus
            sem.
            Nam tincidunt justo ex, at rhoncus dolor sollicitudin ac."</p>
          <span class="review-date">Reviewed on April 5th, 2023</span>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="review-card">
          <img src="../images/person/person3.jpg" alt="Reviewer Name" class="reviewer-image mb-2">
          <h3 class="reviewer-name">Sofia Martin</h3>
          <p class="review-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae sem nec nisi
            molestie
            feugiat vel quis arcu. Praesent quis posuere quam. Maecenas eu lectus consequat, dapibus odio id, maximus
            sem.
            Nam tincidunt justo ex, at rhoncus dolor sollicitudin ac."</p>
          <span class="review-date">Reviewed on February 12th, 2023</span>
        </div>
      </div>
    </div>
  </div>

  <section>
    <div style="margin:70px"></div>
  </section>

  <?php require "footerCar.php" ?><!-- Footer -->


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
</body>

</html>