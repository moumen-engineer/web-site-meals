<?php

include("config.php");  


if(isset($_POST['update'])){
    $ID = $_POST['id'];
    $NAME = $_POST['name'];         //post signifie met dans la base de donnees
    $PRICE = $_POST['price'];                       
    $IMAGE = $_FILES['image'];
    $image_location = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_up = "images/".$image_name;
    $update = "UPDATE products SET name='$NAME' , price='$PRICE', image='$image_up' WHERE id=$ID";   // moodifier les information du produit a la table prod de la bdd
    mysqli_query($con , $update);

    if(move_uploaded_file($image_location, "images/".$image_name)){
        echo "<script>alert('the product has been updated successfully')</script>";
    }else{
        echo "<script>alert('a problem occurred, the product was not updated')</script>";
    }
    header('location: index.php');  //cette fonction pour retourner a la page index.php automatiquement quand on import le produit (rester dans la page index.php)
}

?>