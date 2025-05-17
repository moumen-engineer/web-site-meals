
<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'the product has already been added to the cart !';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'the product is added to the cart !';
   }

};

?>

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
    <link rel="stylesheet" href="admin/index.css">   <!--- relié le fichier css avec code html --->
    <style>
        body{
            background-image: url('image_web/2419fd78dc31c2a4defc3a8558675ef3 copy.jpg');
        }
        h3{
            font-family: "Encode Sans Expanded", sans-serif;
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 30px;
            font-size: 55px;
        }
        h5{
            font-family: "Encode Sans Expanded", sans-serif;
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 30px;
            font-size: 25px;
            padding: 3%;
        }
        h6{
            font-family: "Encode Sans Expanded", sans-serif;
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 30px;
            font-size: 65px;
            color: white;
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
            margin-top: 30px;
            margin-bottom: 1%;
            font-family: "Encode Sans Expanded", sans-serif;
        }
        h5{
            font-family: "Encode Sans Expanded", sans-serif;
        }
        .navbar-brand{
            margin-left: 70px;
        }
        .product-image{
            margin-left: 10px;
            margin-top: 10px;
            box-shadow: 1px 1px 10px black;
        }
        .magasin-image{
            border-radius: 20px;
        }
        .signout{
            padding: 7px 20px;
            background-color: white;
            font-weight: bold;
            color: black;
            text-decoration: none;
            border-radius: 10px;
            font-family: "Encode Sans Expanded", sans-serif;
        }
        .user-profile{
            margin-left: 40px;
            margin-top: 20px;
        }
        p{
            font-weight: bold;
            font-size: 30px;
            font-family: "Encode Sans Expanded", sans-serif;
        }
        span{
            color: white;
        }
        .box{
            width: 40%;
        }
        .imgproduct{
            border-radius: 20px;
            box-shadow: 2px 2px 10px black;
        }
        .logo{
            margin-right: 700px;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .description{
            animation: fadeInUp 1s ease-in-out;
        }
        .welcome{
            animation: fadeInUp 1s ease-in-out;
        }
        .animated-image {
            animation: fadeInUp 1s ease-in-out;
        }
        .animated-logo{
            animation: fadeInUp 1s ease-in-out;
        }
        input{
            width: 200px;
        }
        .message{
            font-size: 20px;
            font-family: "Encode Sans Expanded", sans-serif;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class= "navbar-brand" href="card.php">my card</a>
        <div class="d-flex justify-content-center align-items-center">
            <img class="logo" src="image_web/c8149e8dd0357b1ff28d5b7401a34921.png" alt="not found" width="110px">
        </div>
    </nav>
    <br>
    <center>
        <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
                }
            }
        ?>
    </center>
    <div class="user-profile">

        <?php
            $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_user) > 0){
                $fetch_user = mysqli_fetch_assoc($select_user);
            };
        ?>

        <p>Current User : <span><?php echo $fetch_user['name']; ?></span> </p>
        <div class="flex">
            <a class="signout" href="shop.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are you sure you want to log out ?');" class="delete-btn">Sign out</a>
        </div>

    </div>

    <center>
        <img class="animated-logo" src="image_web/c8149e8dd0357b1ff28d5b7401a34921.png" alt="" width="350px">
        <h6 class="welcome">welcome to our fast food</h6>
        <h5 class="description">Join us today and discover why we're the go-to destination for fast, flavorful meals that never disappoint. Your next delicious adventure awaits at burgers!</h5>
        <img src="image_web/magasin.jpeg" class="magasin-image animated-image" width="900px">
        <h3>all meals available</h3>
    </center>
    
    <div class="products">

        <div class="box-container">

            <?php
                include('config.php');
                $result = mysqli_query($conn, "SELECT * FROM products");      
                while($row = mysqli_fetch_array($result)){
            ?>
            <center>
                <div class="container">
                    <div class="card" style="width: 18rem; background-color: #f0f0f0;">
                        <img class="card-img-top" src="admin/<?php echo $row['image']; ?>" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['price']; ?></p>
                            <form method="post" action="">
                                <input type="number" min="1" name="product_quantity" value="1">
                                <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                <input class="price" type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                <input type="submit" value="Add to Cart" name="add_to_cart" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </center>
            <?php
                };
            ?>

        </div>

    </div>

</body>
</html>




