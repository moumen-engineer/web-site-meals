<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online shop | add products</title>      <!--- le titre de site --->
    <link rel="stylesheet" href="index.css">   <!--- relié le fichier css avec html --->
</head>
<body>
    <center>
        <div class="main">
            <main>
                <form action="insert.php" method="post"  enctype = "multipart/form-data">    <!--- une nouvelle page appeler insert pour inserer le nom et prix et image de produit--->
                    <h2>web site marketing online</h2>          <!-- enctype = pour on peut importer les images --->
                    <img src="c8149e8dd0357b1ff28d5b7401a34921.png" alt="not find" width="300px">
                    <div>
                        <span>Name :</span>
                        <input type="text" name='name'>
                    </div>
                    <br>        <!--- soter la ligne --->
                    <div>
                        <span>Price  :</span>                                   
                        <input type="text" name='price'>
                    </div> 
                    <br>
                    <input type="file" id="file" name="image" style='display:none;'>    <!--- hide file by display:none --->
                    <label for="file">choose image of the product</label>
                    <br><br>
                    <button name='upload'>upload product</button>
                    <br><br>
                    <a href="product.php">show all products</a>   <!--- une nouvelle page appeler product --->
                </form>
            </main>
            
        </div> 
        <p>developper by groupe project BBD</p>
    </center>
</body>
</html>