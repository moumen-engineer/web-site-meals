
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

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'the shopping cart quantity has been updated successfully !';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:card.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:card.php');
}
if(isset($_POST['submit'])){

    $location = mysqli_real_escape_string($conn, $_POST['location']);

    mysqli_query($conn, "UPDATE `users` SET location = '$location' WHERE id = '$user_id'") or die('query failed');
    $message[] = 'Location added successfully!';
    header('location:shop.php');

}
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
            background-image: url('image_web/card-background.webp');
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
        <a class= "navbar-brand" href="shop.php"> Home</a>
    </nav>   
    <center>
        <h3>your reserved meals</h3>
        <br>
        <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
                }
            }
        ?>
        <br>
        <table>
        <thead>
            <th>image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>total price</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php
            $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            $grand_total = 0;
            if(mysqli_num_rows($cart_query) > 0){
                while($fetch_cart = mysqli_fetch_assoc($cart_query)){
        ?>
            <tr>
                <td><img src="admin/<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
                <td><?php echo $fetch_cart['name']; ?></td>
                <td><?php echo $fetch_cart['price']; ?>DA </td>
                <td>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="submit" name="update_cart" value="Save" class="option-btn">
                </form>
                </td>
                <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>DA</td>
                <td><a class="delete" href="card.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove the item from the shopping cart ?');">Delete</a></td>
            </tr>
        <?php
            $grand_total += $sub_total;
                }
            }else{
                echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">the cart is empty</td></tr>';
            }
        ?>
        <tr class="table-bottom">
            <td colspan="4">Total amount :</td>
            <td><?php echo $grand_total; ?>DA</td>
            <td><a class="delete" href="card.php?delete_all" onclick="return confirm('Delete all products from the cart');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Delete all</a></td>
        </tr>
        </tbody>
        </table>
        <br>
        <form action="" method="post" >
            <br><br>
            <input type="submit" name="submit" class="btn" value="confirm commande">
        </form>
        <br>
    <center>
</body>
</html>