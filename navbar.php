<!-- NAVBAR START -->
<div class="color fixed-top">
  <div class="container-fluid" id="navbar">
    <div class="container color">
      <div class="row color">
        <div class="col-12 color">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand col-md-2 col-xs-3 " href="index.html">
              <img src="images/institutional/logo2.png" alt="Vehride" width="180">
            </a>

            <button class="navbar-toggler color" id="hamburgerMenu" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon "></span>
            </button>

            <div class="col-4 menu color collapse navbar-collapse btasd" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0 color">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="
                                    <?php $vehicle = $_COOKIE['vehicle'];
                                    if ($vehicle == 'car') {
                                      echo "car/car.php";
                                    }
                                    if ($vehicle == 'motorcycle') {
                                      echo "moto/moto.php";
                                    } ?>">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="
                  <?php $vehicle = $_COOKIE['vehicle'];
                  if ($vehicle == 'car') {
                    echo "car/reservation.php";
                  }
                  if ($vehicle == 'motorcycle') {
                    echo "moto/reservation.php";
                  } ?>">Rezervation</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Vehicles
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="car/vehiclesCar.php">Car</a></li>
                    <li><a class="dropdown-item" href="moto/vehiclesMoto.php">Motorcycle</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="contact.php">Contact US</a>
                </li>
                <li class="nav-item sign">
                  <a class="nav-link active" aria-current="page" href="login.php">SIGN UP / LOGIN</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- NAVBAR END -->