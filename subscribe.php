<?php
function myFunction()
{
    $email = NULL;  
    require "db.php";
    if (!empty($_POST)) {
        if (isset($_POST['email']) && ($_POST['email'] != '')) {
            $email = $_POST['email'];
            $sql = "INSERT INTO `subscribe` (`email`) VALUES ('$email')";
            try {
            $result = mysqli_query($conn, $sql);
            if ($result) {
              echo '<p style="color: #86e4a2"> New record created successfully </p>';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            } } catch (mysqli_sql_exception $e) {
              echo '<p style="color: #a63737"> Record unsuccessfully (You may have subscribe up before.) </p>';
            }
        } else {
            echo '<p style="color: #a63737"> Email address is required </p>';
        }
    }
}

echo myFunction();
?>