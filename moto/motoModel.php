<?php
$options = '';
$brand_id = $_POST['brand'];
require "../db.php";

// Query to fetch models
$sql = "SELECT * FROM moto_model WHERE brand_id = ".$brand_id;
$result = $conn->query($sql);

// Return results
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['id'] . "'>" . $row['model_name'] . "</option>";
  }
} else {
    $options .= "<option value=''>No models found</option>";
}

echo $options;
?>