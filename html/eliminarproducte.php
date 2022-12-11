<?php
session_start();
include("connexio.php");

if ($_SESSION["usr"] != "admin@admin.com") {
    header("Location: index.php");
}

if (isset($_POST['Beliminar'])) {

$producte = $_POST['select_producte'];
$sql = "DELETE FROM `producte` WHERE `codiProducte` = '$producte'";
$execute = mysqli_query($connexio,$sql);
?>
<br><br>
    <div class="container">
        <p style ="color: green;">Producte eliminat</p>
    </div>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../stylee.css" rel="stylesheet" type="text/css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- Fots awesome -->
    <script src="https://kit.fontawesome.com/9210da3ccb.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../imgs/logo.jpg">
    <title>Eliminar Producte</title>
</head>
<body>
    <div class="container">
        <h1>Eliminar producte</h1>
        <a href="admin.php" name="" value="" class="btn btn-primary" role="button"> Tornar ←</a>
        <br><br>

        <form action="" class="" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <!-- Seccio desplegable -->
            <label for="">Selecciona el producte a eliminar:</label>
            <select name="select_producte" class="form-control">
                <option value="" disabled selected>Selecciona una producte.</option>
                <?php 
                $sql="SELECT * FROM `producte`";
                $execute = mysqli_query($connexio, $sql);

                while($lineas = mysqli_fetch_array($execute)){
                ?>
                <option value="<?php echo $lineas['codiProducte'];?>"><?php echo $lineas['nom'];?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <input type="submit" name="Beliminar" value="Eliminar producte">
        </form>
        <br>
    </div>


</body>
</html>