<!-- NAVBAR START -->
<div class="color fixed-top">
    <div class="container-fluid" id="navbar" style="border-bottom:1px solid #6f6f6f9f">
        <div class="container color">
            <div class="row color">
                <div class="col-12 color">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand col-md-2 col-xs-3 " href="../index.html">
                            <img src="../images/institutional/logo2.png" alt="Vehride" width="180">
                        </a>

                        <button class="navbar-toggler color" id="hamburgerMenu" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon "></span>
                        </button>

                        <div class="col-4 menu color collapse navbar-collapse btasd" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 color">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="car.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="reservation.php">Reservation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="vehiclesCar.php">Vehicles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="../contact.php">Contact US</a>
                                </li>
                                <li class="nav-item sign">
                                    <a class="nav-link active" aria-current="page" onclick="confirmExit()">LOG OUT</a>
                                </li>

                                <script>
                                    function confirmExit() {
                                        var answer = confirm("Are you sure you want to log out?");
                                        if (answer) {
                                            alert("Exit is done!");
                                            // AJAX
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('GET', '../logout.php', true);
                                            xhr.onload = function () {
                                                if (xhr.status === 200) {
                                                    window.location.href = "car.php";
                                                } else {
                                                    alert('Logout failed.');
                                                }
                                            };
                                            xhr.send();
                                        } else {
                                            return false;
                                        }
                                    }
                                </script>


                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- NAVBAR END -->