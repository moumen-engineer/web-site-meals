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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-N3t6x2/oVRw6j/EGaB6cFeo3F6QrNcspY3NwrL6cwquMpI5l9z0OtPVLepRp+E7pXlMrd1FgF63exrXFuA9HMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my cart | my meals</title>      <!--- le titre de site --->
    <style>
        body{
            background-image: url('2419fd78dc31c2a4defc3a8558675ef3.jpg');
        }
        h3{
            margin-top: 35px;
            font-family: "Encode Sans Expanded", sans-serif;
            margin-bottom: 50px;
            font-size: 45px;
            color: white;
            text-decoration: bold;
        }
        main{
            width: 70%;
            border-radius: 10%;
        }
        table{
            box-shadow: 1px 1px 10px black;
            border-radius: 10px;
            width: 60%;
        }
        thead{
            background-color:  #2f2f2f;
            text-align: center;
            height: 50px;
        }
        tbody{
            text-align: center;
            background-color: white;
            height: 40%;
        }
        .navbar-brand{
            margin-left: 70px;
        }
        a{
            margin-top: 10px;
            margin-bottom: 1%;
            font-family: "Encode Sans Expanded", sans-serif;
        }
        th{
            color: white;
            text-decoration: bold;
            font-family: "Encode Sans Expanded", sans-serif;
        }
        .delete{
            padding: 7px 20px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-family: "Encode Sans Expanded", sans-serif;
        }
        .btn{
            padding: 7px 20px;
            background-color: green;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 10px;
            font-family: "Encode Sans Expanded", sans-serif;
        }
        .table-bottom{
            height: 50px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class= "navbar-brand" href="product.php"> Show products</a>
    </nav>   
    <center>
        <h3>Customer requests</h3>
        <br>
        <table>
        <thead>
            <th>image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>total price</th>
            <th>User Email</th>
            <th>location</th>
        </thead>
        <tbody>
        <?php
            $bool = false;
            $cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $select_user = mysqli_query($con, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_user) > 0){
                    $fetch_user = mysqli_fetch_assoc($select_user);
                };
            $grand_total = 0;
            if(mysqli_num_rows($cart_query) > 0){
                while($fetch_cart = mysqli_fetch_assoc($cart_query)){
        ?>
                    <tr>
                        <td><img src="<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
                        <td><?php echo $fetch_cart['name']; ?></td>
                        <td><?php echo $fetch_cart['price']; ?>DA </td>
                        <td>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                            <span><?php echo $fetch_cart['quantity']; ?></span>
                        </form>
                        </td>
                        <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>DA</td>
                        <!-- affichage email -->
                        <td><?php echo $fetch_user['email']; ?></td>
                        <td><?php echo "" ?></td>
                    </tr>       
        <?php
                    $grand_total += $sub_total;
                }
            }else{
                echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no requests</td></tr>';
                $bool = true;
            }
        ?>
        <tr class="table-bottom">
            <td colspan="4">Total amount :</td>
            <td><?php echo $grand_total; ?>DA</td>
            <?php
                if($bool != true){
            ?>
            <td><?php echo $fetch_user['name']; ?></td>
            <td><?php echo $fetch_user['location']; ?></td>  
            <?php
                }else{
            ?>
            <td><?php echo "No user" ?></td> 
            <?php

                }
            ?>
        </tr>
        </tbody>
        </table>
    <center>
</body>
</html>