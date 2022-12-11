<?php
session_start();
include("connexio.php");

if ($_SESSION["usr"] != "admin@admin.com") {
    header("Location: index.php");
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
    <title>Modificar Producte</title>
</head>
<body>
<div class="container">
            <h1>Modificar producte</h1>
            <a href="admin.php" name="" value="" class="btn btn-primary" role="button"> Tornar ←</a>
            <br><br>
        <!-- PRIMER FORMULARI (SELECT) -->
        <form action="" class="" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <!-- Seccio desplegable -->
                <label for="">Selecciona el producte a modificar:</label>
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
            <input type="submit" name="modificaP" value="Modifica">
        </form>
    </div>
    
    <?php
    //SEGON FORMULARI (MOSTRAR DADES)
    if (isset($_POST['modificaP'])) {

            $sql = "SELECT * FROM `producte` WHERE `codiProducte` = '".$_POST['select_producte']."'";
            $execute = mysqli_query($connexio, $sql);

            while ($lineas = mysqli_fetch_array($execute)) {
            ?>
            <br><br>
            <div class="container">
                <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Nom*</label>
                    <input type="text" class="form-control" name="nomM" placeholder="Titol" value="<?php echo $lineas['nom'];?>">
                </div>
                <div class="form-group">
                    <label for="">Descripció*</label>
                    <textarea class="form-control" rows="4" name="descripcioM" placeholder="<?php echo $lineas['descripcio'];?>" ></textarea>
                </div>
                <div class="form-group">
                    <label for="">Preu*</label>
                    <input type="number" class="form-control" name="preuM" placeholder="<?php echo $lineas['preu']."€";?>">
                </div>
                <div class="form-group">
                    <label for="">Stock*</label>
                    <input type="number" class="form-control" name="stockM" placeholder="Stock" value="<?php echo $lineas['stock'];?>">
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="">Imatge*</label>
                    <input type="file" name="fotoM">
                    <p class="help-block">Nova imatge.</p>
                </div>

                <div class="form-group">
                    <label for="">Contingut</label>
                    <input type="hidden" name="invisible" value="<?php echo $lineas['codiProducte']; ?>">
                    <input type="text" class="form-control" name="contingutM" placeholder="Contingut" value="<?php echo $lineas['contingut'];?>">
                </div>

                <input type="submit" name="modificaM" value="Modificar el producte">
                <br><br>
                </form>
            </div>
  <?php
  }
}
?>
<?php
//TERCER FORMULARI (UPDATE)
if (isset($_POST['modificaM'])) {
    if (!empty($_POST['nomM']) && !empty($_POST['descripcioM']) && !empty($_POST['preuM']) && !empty($_POST['stockM'])
    && !empty($_FILES['fotoM']['tmp_name'])&& !empty($_POST['contingutM'])){

        $nom = $_POST['nomM'];
        $descripcio = $_POST['descripcioM'];
        $preu = $_POST['preuM'];
        $stock = $_POST['stockM'];
        $contingut = $_POST['contingutM'];
        $hid = $_POST['invisible'];

        $temporal = $_FILES['fotoM']['tmp_name'];
        $tipus = $_FILES['fotoM']['type'];

        $dadesimatge = file_get_contents($temporal);
        $dadesimatge = mysqli_real_escape_string($connexio, $dadesimatge);

        $sql = "INSERT INTO `producte`(`nom`, `descripcio`, `preu`, `stock`, `dadesImatge`, `tipusImatge`, `contingut`) 
        VALUES ('$nom','$descripcio','$preu','$stock','$dadesimatge','$tipus','$contingut')";

        $sql="UPDATE `producte` SET `nom`= '$nom' ,`descripcio`= '$descripcio',`preu`= '$preu',`stock`= '$stock', `dadesImatge`= '$dadesimatge', `tipusImatge` = '$tipus', `contingut` = '$contingut'
        WHERE `codiProducte` = '$hid'";

        mysqli_query($connexio, $sql);

?>         
        <br><br>
        <div class="container">
            <p style="color: green;">Producte modificat correctament.</p>
        </div>
    <?php
    } else {
    ?>
        <br><br>
        <div class="container">
            <p style="color: red;">Dades no enviades, algun camp buit.</p>
        </div>
<?php
    }
}
?>
</body>
</html>