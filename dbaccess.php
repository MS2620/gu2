<?php

$servername = "comp-server.uhi.ac.uk";
$username = "sql08013495";
$password = "sql08013495";
$database = "sql08013495";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error){
    die ("Connection failed: " . $conn->connect_error);
} else {
  //echo "Connected Successfully";
}

?>
