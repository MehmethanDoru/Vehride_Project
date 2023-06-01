<?php
require "db.php";
$sql = "SELECT * FROM `bank_accounts` ";
$result = mysqli_query($conn, $sql);

$banks = array();
if (mysqli_num_rows($result) > 0) {
  $banks = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
  <link rel="stylesheet" href="css/bank.css">
  <link rel="stylesheet" href="css/default.css">
  <link rel="icon" type="image/x-icon" href="images/institutional/favicon.png" />
  <title>Bank Accounts | VEHRIDE</title>
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

  <div class="container" style="margin-top:95px; margin-bottom: 23px; border: 1px solid rgba(255, 0, 0, 0.0); ">
    <div style="margin-top:20px;">
      <h6><strong>You can see our bank accounts below! </strong></h6>
    </div>

  </div>
  <div class="container" style="margin-bottom: 89px;">
    <div class="row">
      <div class="col-md-4 col-sm-6">
        <div class="account">
          <div class="logo">
            <img src="images/bankAccounts/DenizBank-logo.png" width="130px" height="28px" alt="DenizBank-logo">
          </div>
          <div class="info">
            <table>
              <tr>
                <td>Bank Name</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[0]['bank_name'] ?>
                </td>
              </tr>
              <tr>
                <td>City / Country</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[0]['bank_city'] . " / " . $banks[0]['bank_country']; ?>
                </td>
              </tr>
              <tr>
                <td>Branch Name</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[0]['branch_name'] ?>
                </td>
              </tr>
              <tr>
                <td>Branch Code</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[0]['branch_code'] ?>
                </td>
              </tr>
              <tr>
                <td>Currency</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[0]['currency'] ?>
                </td>
              </tr>
              <tr>
                <td>Account Holder</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[0]['account_holder'] ?>
                </td>
              </tr>
              <tr>
                <td>Account No</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[0]['account_number'] ?>
                </td>
              </tr>
              <tr>
                <td>IBAN</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[0]['iban'] ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="account">
          <div class="logo">
            <img src="images/bankAccounts/luminor-logo.png" width="130px" height="28px" alt="luminor-logo">
          </div>
          <div class="info">
            <table>
              <tr height="25">
                <td>Bank Name</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[1]['bank_name'] ?>
                </td>
              </tr>
              <tr>
                <td>City / Country</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[1]['bank_city'] . " / " . $banks[1]['bank_country']; ?>
                </td>
              </tr>
              <tr>
                <td>Branch Name</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[1]['branch_name'] ?>
                </td>
              </tr>
              <tr>
                <td>Branch Code</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[1]['branch_code'] ?>
                </td>
              </tr>
              <tr>
                <td>Currency</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[1]['currency'] ?>
                </td>
              </tr>
              <tr>
                <td>Account Holder</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[1]['account_holder'] ?>
                </td>
              </tr>
              <tr>
                <td>Account No</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[1]['account_number'] ?>
                </td>
              </tr>
              <tr>
                <td>IBAN</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[1]['iban'] ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="account">
          <div class="logo">
            <img src="images/bankAccounts/State-Street-Logo.png" width="130px" height="28px" alt="State-Street-Logo">
          </div>
          <div class="info">
            <table>
              <tr height="25">
                <td>Bank Name</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[2]['bank_name'] ?>
                </td>
              </tr>
              <tr>
                <td>City / Country</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[2]['bank_city'] . " / " . $banks[2]['bank_country']; ?>
                </td>
              </tr>
              <tr>
                <td>Branch Name</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[2]['branch_name'] ?>
                </td>
              </tr>
              <tr>
                <td>Branch Code</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[2]['branch_code'] ?>
                </td>
              </tr>
              <tr>
                <td>Currency</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[2]['currency'] ?>
                </td>
              </tr>
              <tr>
                <td>Account Holder</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[2]['account_holder'] ?>
                </td>
              </tr>
              <tr>
                <td>Account No</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[2]['account_number'] ?>
                </td>
              </tr>
              <tr>
                <td>IBAN</td>
                <td>&emsp;:&nbsp;</td>
                <td>
                  <?php echo $banks[2]['iban'] ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require "footer.php" ?><!-- Footer -->
</body>

</html>