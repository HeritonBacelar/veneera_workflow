<?php

include_once('dbConn.php');

$sql = "SELECT * FROM shopify_order";
$results = mysqli_query($conn, $sql);
$json_array = array();

while ($data = mysqli_fetch_assoc($results)) {

  $json_array[] = $data;

}

echo json_encode($json_array);


?>