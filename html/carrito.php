<?php
session_start();
include("connexio.php");
?>

<?php
//TORNAR BOTIGA
if (isset($_POST["tornarB"])) {
    header("Location: botiga.php");
}
//LOG OUT
if (isset($_POST['sortir'])) {
    session_destroy();
    header("Location: index.php");
}

if (isset($_POST['Bfinal'])) {

    $mailS = $_SESSION["usr"];
    $date = date('Y-m-d');

    //COMPRA
    $sql="INSERT INTO `compra`(`data`, `email`) 
    VALUES ('$date','$mailS')";

    mysqli_query($connexio, $sql);

    //CODI COMPRA
    $sql = "SELECT MAX(codiCompra) as codi FROM `compra`";
    $execute = mysqli_query($connexio, $sql);
    $resultat =  mysqli_fetch_array($execute);
    $codiC = $resultat['codi'];
    

    //INSERTAR COMANDA
    foreach ($_SESSION["carrito"] as $key => $value){
        $sql = "INSERT INTO `comanda`(`codiCompra`, `codiProducte`) 
        VALUES ($codiC,$value)";
        mysqli_query($connexio, $sql);
        $sql = "UPDATE `producte` SET `stock` = (`stock` - 1)  WHERE `codiProducte` = $value";
        mysqli_query($connexio, $sql);
    }
    

    $_SESSION["carrito"] = [];
    $array = [];
    
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
    <title>Carrito - SergiSabater</title>
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
            <a class="navbar-brand brand" href="#">Botiga Virtual - Sergi Sabater</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
            
                <li style="margin-right: 35px;">
                    <br>
                    <form class="form" action="" method="post" enctype="multipart/form-data"> 
                    <input type="submit"  value="Botiga ←" name="tornarB"></input>
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

        <div class="banner banner3">
            <img src="../imgs/banner3.jpg" alt="">
        </div>  
        <br>
        <h1>Carrito de la compra</h1>

        <?php
           foreach ($_SESSION["carrito"] as $key => $value) {
   
            $sql = "SELECT * FROM `producte` WHERE `codiProducte` = $value";
            $resultat = mysqli_query($connexio,$sql);
            
            while($fila = mysqli_fetch_array($resultat)){
                ?>
                <div class="col-md-12">
                    <div class="text-center col">
                        <div class="caja2">
                        <?php 
                        echo '<img class ="foto"src="data:'.$fila['tipusImatge'].';base64,'.base64_encode($fila['dadesImatge']).'">';
                        echo "<br>";
                        ?>
                        <h3><?php echo $fila['nom']?></h3>
                        <p><?php echo $fila['descripcio']?></p>
                        <p><?php echo $fila['preu']." €"?></p>
                        <h2><?php echo "x 1"?></h2>
                        <br>                    
                        </div>
                    </div>
                </div>
                   
                <?php
                
             }
            }
            ?>
            <div class="container text-center">
                <form class="form" action="" method="post" enctype="multipart/form-data">
                    <input type="submit" class="btn btn-success" value="Comprar" name="Bfinal"></input>
                </form>
            </div>
            <br><br>
    </body>
</html>