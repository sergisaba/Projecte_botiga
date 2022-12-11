<?php
session_start();
include("connexio.php");

if ($_SESSION["usr"] != "admin@admin.com") {
    header("Location: index.php");
}

//CAMBIAR
if (isset($_POST['formP'])) {
    if (!empty($_POST['nomP']) && !empty($_POST['descripcioP']) && !empty($_POST['preuP']) && !empty($_POST['stockP'])
    && !empty($_FILES['fotoP']['tmp_name'])&& !empty($_POST['contingutP'])){

        $nom = $_POST['nomP'];
        $descripcio = $_POST['descripcioP'];
        $preu = $_POST['preuP'];
        $stock = $_POST['stockP'];
        $contingut = $_POST['contingutP'];

        $temporal = $_FILES['fotoP']['tmp_name'];
        $tipus = $_FILES['fotoP']['type'];

        $dadesimatge = file_get_contents($temporal);
        $dadesimatge = mysqli_real_escape_string($connexio, $dadesimatge);

        $sql = "INSERT INTO `producte`(`nom`, `descripcio`, `preu`, `stock`, `dadesImatge`, `tipusImatge`, `contingut`) 
        VALUES ('$nom','$descripcio','$preu','$stock','$dadesimatge','$tipus','$contingut')";

        mysqli_query($connexio, $sql);

?>         
        <br><br>
        <div class="container">
            <p style="color: green;">Nou producte enviat.</p>
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
    <title>Afegir Producte</title>
</head>

<body>
    <div class="container">
        <h1>Afegir nou producte</h1>
        <a href="admin.php" name="" value="" class="btn btn-primary" role="button"> Tornar ←</a>
        <br><br>
        <br>
        <!-- FORMULARI AFEGIR NOTICIA -->
        <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Nom*</label>
                <input type="text" class="form-control" name="nomP" placeholder="Titol">
            </div>
            <div class="form-group">
                <label for="">Descripció*</label>
                <textarea class="form-control" rows="4" name="descripcioP" placeholder="..."></textarea>
            </div>
            <div class="form-group">
                <label for="">Preu*</label>
                <input type="number" class="form-control" name="preuP" placeholder="€">
            </div>
            <div class="form-group">
                <label for="">Stock*</label>
                <input type="number" class="form-control" name="stockP" placeholder="Stock">
            </div>
            <div class="form-group">
            </div>
            <div class="form-group">
                <label for="">Imatge*</label>
                <input type="file" name="fotoP">
                <p class="help-block">Penja la teva imatge.</p>
            </div>

            <div class="form-group">
                <label for="">Contingut</label>
                <input type="text" class="form-control" name="contingutP" placeholder="Contingut">
            </div>

            <input type="submit" name="formP" value="Envia">
        </form>
        <br>
    </div>
</body>
</html>