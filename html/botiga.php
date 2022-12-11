<?php
session_start();

$usuari = $_SESSION["usr"];
include("connexio.php");

if (isset($_POST['sortir'])) {
    session_destroy();
    header("Location: index.php");
}


if (isset($_POST['Bcomprar'])) {

    $inv = $_POST['invisible'];

    if (isset($_SESSION["carrito"])){   
        $array = $_SESSION["carrito"];
        array_push($array,$inv);
        $_SESSION["carrito"] = $array;
  
    }else{

        $array = [];
        array_push($array,$inv);
        $_SESSION["carrito"] = $array;

    }
}


if (isset($_POST['carrito'])) {
    header("Location: carrito.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- Fots awesome -->
    <script src="https://kit.fontawesome.com/9210da3ccb.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../imgs/logo.jpg">
    <title>Botiga - SergiSabater</title>
</head>
    <body>
       
        <!-- NAVBAR -->
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
        
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a style="margin-left: 35px;" class="navbar-brand brand" href="#">Botiga Virtual - Sergi Sabater</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
               
                <li class="usr"><br><?php echo "Usuari: $usuari"?></li>
                <li style="margin-right: 15px;">
                <br>
                <!-- botó carrito -->
                    <form class="form" action="" method="post" enctype="multipart/form-data"> 
                    <input type="submit"  value="Carrito →" name="carrito"></input>
                    </form>
                </li>
                    
                <li style="margin-right: 35px;">
                    <br>
                    <form class="form" action="" method="post" enctype="multipart/form-data"> 
                    <input type="submit"  value="Log-out" name="sortir"></input>
                    </form>
                </li>
             
            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>
        

        <!-- BANNER -->
        <div class="banner banner2">
            <img src="../imgs/banner2.jpg" alt="">
        </div>
        <br>
        <h1>Productes</h1>
        <br><br>
        <div class="container">
        <div class="row row2">
        <?php

        $sql = "SELECT * FROM `producte`";
        $resultat = mysqli_query($connexio,$sql);

        while($fila = mysqli_fetch_array($resultat)){
            ?>
                <div class="col-md-4 text-center col">
                    <div class="caja">
                    <?php 
                    echo '<img src="data:'.$fila['tipusImatge'].';base64,'.base64_encode($fila['dadesImatge']).'">';
                    echo "<br>";
                    ?>
                    <h3><?php echo $fila['nom']?></h3>
                    <p><?php echo $fila['descripcio']?></p>
                    <p><?php echo $fila['preu']." €"?></p>
                    <!-- Botó comprar -->
                    <form class="form" action="" method="post" enctype="multipart/form-data">
                        <input type="submit" class="btn btn-success" value="Comprar" name="Bcomprar"></input>
                        <input type="hidden" name="invisible" value="<?php echo $fila['codiProducte'];?>">
                    </form>
                    <br>
                    </div>
                </div>
            <?php
         }
        ?>
        </div>
        </div>
    </body>
</html>