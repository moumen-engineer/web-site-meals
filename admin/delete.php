<?php

include("config.php");


$ID = $_GET['id'];   // GET signifie give me from la base de donnees
mysqli_query($con, "DELETE FROM products WHERE id=$ID");
header('location: product.php');

?>

