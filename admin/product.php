<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show products</title>      <!--- le titre de site --->
    <link rel="stylesheet" href="index.css">   <!--- relié le fichier css avec code html --->
    <style>
        h3{
            margin-top: 30px;
            font-family: "Encode Sans Expanded", sans-serif;
            font-weight: bold;
            margin-bottom: 30px;
            font-size: 55px;
        }
        .card{
            float: right;
            margin-top: 30px;
            margin-left: 30px;
            margin-right: 70px;
        }
        .card img{
            width: 100%;
            height: 300px
        }
        main{
            width: 80%;
        }
        a{
            margin-bottom: 3%;
            font-family: "Encode Sans Expanded", sans-serif;
            width: 230px;
        }
        h5{
            font-family: "Encode Sans Expanded", sans-serif;
        }
        .confirm{
            padding: 7px 20px;
            background-color: white;
            color: black;
            font-weight: bold;
            text-decoration: none;
            border-radius: 10px;
            font-family: "Encode Sans Expanded", sans-serif;
            width: 14%;
            margin-left: 30px;
        }
        .cart-form {
            display: inline-block; /* Affiche les formulaires en ligne */
            margin-right: 10px; /* Ajoute un peu d'espace entre les formulaires */
        }
        .confirm {
            width: 200px;
        }
    </style>
</head>
<body>
    <br>
        <form method="post" action="commands.php" class="cart-form">
            <input type="submit" value="show commands" class="confirm">
        </form>
        <form method="post" action="index.php" class="cart-form">
            <input type="submit" value="Home admin" class="confirm">
        </form>
    <center>
        <h3>admin control panel</h3>
    </center>
    <?php
    include("config.php"); // pour on peut utiliser la variable $con
    $result = mysqli_query($con ,"SELECT * FROM products");   //appeler tout les produit from la table prod depuis la bdd dans la var $con
    while($row = mysqli_fetch_array($result)){  // parcourir tout les produit (produit par produit dans la bdd)
        echo "
            <center>
                <main>
                        <div class='card' style='width: 18rem;'>
                            <img src='$row[image]'' class='card-img-top' >   
                            <div class='card-body'>
                                <h5 class='card-title'>$row[name]</h5>
                                <p class='card-text'>$row[price]</p>
                                <a href='delete.php? id=$row[id]' class='btn btn-danger'>Delete a product</a>    
                                <a href='update.php? id=$row[id]' class='btn btn-warning'>modification to the product</a>
                            </div>
                        </div>
                    </main>

            <center>
        ";
    }
    
    ?>

</body>
</html>