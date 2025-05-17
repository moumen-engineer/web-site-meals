<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update product</title>      <!--- le titre de site --->
    <link rel="stylesheet" href="index.css">   <!--- relié le fichier css avec html --->
</head>
    <style>
        .inputid{
            margin-left: 4%;
        }
        .inputprice{
            margin-left: 2%;
        }
        .inputname{
            margin-left: 1%;
        }
    </style>
<body>
    <?php
        include("config.php");
        $ID = $_GET['id'];
        $up = mysqli_query($con ,"SELECT * FROM products WHERE id=$ID");
        $data = mysqli_fetch_array($up);
    ?>
    <center>
        <div class="main">
            <form action="up.php" method="post"  enctype = "multipart/form-data">    <!--- une nouvelle page appeler up pour modifier le nom et prix et image de produit--->
                <h2>update product</h2>          <!-- enctype = pour on peut importer les images --->
                <div>
                    <span>id :</span>
                    <input class="inputid" type="text" name='id' value = '<?php echo $data['id']?>'>
                </div>
                <br>
                <div>
                    <span>Name :</span>
                    <input class="inputname" type="text" name='name' value = '<?php echo $data['name']?>'>
                </div>
                <br> 
                <div>
                    <span>Price :</span>
                    <input class="inputprice" type="text" name='price' value = '<?php echo $data['price']?>'>
                </div>                                    <!--- soter la ligne --->
                <br>
                <input type="file" id="file" name="image" style='display:none;'>    <!--- hide file by display:none --->
                <br>
                <label for="file">update image of product</label>
                <br><br>
                <button name='update'>update the product</button>
                <br><br>
                <a href="product.php">show all products</a>   <!--- une nouvelle page appeler product --->
            </form>
        </div> 
    </center>
</body>
</html>