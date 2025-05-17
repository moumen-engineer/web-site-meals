<?php

include 'config.php';

if(isset($_POST['submit'])){
   
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $location = mysqli_real_escape_string($conn, $_POST['location']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `users`(name, location, email, password) VALUES('$name','$location', '$email', '$pass')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      body{
         background-image: url('image_web/login.webp');
      }
      input{
         text-align: center;
      }
      .btn{
         background-color: orange;
         font-weight: bold;
      }
      .form-container form{
         box-shadow: 1px 1px 10px black;
         width: 500px;
         border-radius: 15px;
         padding:20px;
         text-align: center;
         background-color: #fcf1c4;
      }
      .form-container form h3{
         font-family: "Encode Sans Expanded", sans-serif;
         font-size: 30px;
         margin-bottom: 10px;
         text-transform: uppercase;
         color:var(--gray);
      }
      .form-container{
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         padding:20px;
         padding-bottom: 70px;
         animation: fadeInUp 1s ease-in-out;
      }
      .form-container form .box{
         width: 100%;
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
   
<div class="form-container">

   <form action="" method="post">
      <img src="image_web/c8149e8dd0357b1ff28d5b7401a34921.png" alt="" width="140px">
      <br>
      <h3>Create a new account</h3>
      <input type="text" name="name" required placeholder="user name" class="box">
      <input type="text" name="location" required placeholder="location" class="box">
      <input type="email" name="email" required placeholder="Email" class="box">
      <input type="password" name="password" required placeholder="password" class="box">
      <input type="password" name="cpassword" required placeholder="confirm password" class="box">
      <input type="submit" name="submit" class="btn" value="Account registration">
      <p>do you have an account ? <a href="login.php">log in</a></p>
   </form>

</div>

</body>
</html>