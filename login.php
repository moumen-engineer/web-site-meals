<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){   // client existe dans la base de donnees 
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:shop.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="css/style.css">
   
   <style>
      body{
         background-image: url('image_web/login.webp');
      }
      input{
         text-align: center;
      }
      .form-container form h3{
         font-family: "Encode Sans Expanded", sans-serif;
         font-size: 30px;
         margin-bottom: 10px;
         text-transform: uppercase;
         color:var(--black);
      }
      .form-container form{
         box-shadow: 1px 1px 10px black;
         width: 500px;
         border-radius: 15px;
         padding:20px;
         text-align: center;
         background-color: #fcf1c4;
      }
      .form-container{
         min-height: 60vh;
         display: flex;
         align-items: center;
         justify-content: center;
         padding:20px;
         padding-bottom: 70px;
         animation: fadeInUp 1s ease-in-out;
      }
      .form-container form .box{
         width: 80%;
         border-radius: 15px;
         padding:12px 14px;
         font-size: 15px;
         margin:10px 0;
      }
      .form-container form p{
         margin-top: 20px;
         font-size: 15px;
         color:var(--black);
      }
      .container{
         padding:0 20px;
         margin:0 auto;
         max-width: 1200px;
         padding-bottom: 70px;
      }
      .btn{
         background-color: orange;
         font-weight: bold;
      }
      h4{
         font-size: 35px;
         font-family: "Encode Sans Expanded", sans-serif;
         color: #3d3d3d;
         position: relative;
         animation: slideRight 3s ease-out forwards;
      }
      h2{
         font-size: 55px;
         font-family: "Encode Sans Expanded", sans-serif;
         color: white;
         position: relative;
         animation: slideRight 2s ease-out forwards;
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
      img {
         position: relative;
         animation: slideLeft 2s ease-out forwards;
      }
      @keyframes slideRight {
         from {
               right: 100%;
         }
         to {
               right: 0;
         }
      }

      @keyframes slideLeft {
         from {
               left: 100%;
         }
         to {
               left: 0;
         }
      }
   </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';   
   }
}
?>
<center>
   <img src="image_web/c8149e8dd0357b1ff28d5b7401a34921.png" alt="" width="300px">
   
   <h2>welcome to our fast food</h2>
   <br>
   <h4>you must enter the account to order your meal</h4>
</center>
<div class="form-container">

   <form action="" method="post">
      <h3>log in</h3>
      <input type="email" name="email" required placeholder="Email" class="box">
      <input type="password" name="password" required placeholder="password" class="box">
      <br>
      <input type="submit" name="submit" class="btn" value="log in">
      <p>do you already have an account ? <a href="register.php">New account</a></p>
   </form>

</div>

</body>
</html>