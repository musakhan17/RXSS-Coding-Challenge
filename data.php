<?php

$inputlatitude = $_POST["latitude"];
$inputlongitude = $_POST["longitude"];

$connect = mysqli_connect("db_host","username", "password", "db_name");

$query = "SELECT `name`, `address`, ( 3959 * acos( cos( radians($inputlatitude) ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians($inputlongitude) ) + sin( radians($inputlatitude) ) * sin( radians( `latitude` ) ) ) ) AS distance FROM `pharmacies` ORDER BY distance LIMIT 1";

$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($result)) {
      echo '<strong> Pharmacy Name: </strong>';  print_r(array_values($row)[0]); echo '<br>';
      echo '<br> <strong>Address: </strong>';  print_r(array_values($row)[1]); echo '<br>';
      echo '<br> <strong>Distance: </strong>';  print_r(number_format(array_values($row)[2],3)); echo ' miles <br>';

     }

/* test for database connection, provides error code if connection is not established
 if (!$connect) {
      echo "Error: Unable to connect to MySQL." . PHP_EOL;
      echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
  }

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($connect) . PHP_EOL;
*/
?>
