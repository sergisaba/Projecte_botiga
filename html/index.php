<?php

include("connexio.php");
//REGISTRA
if (isset($_POST['Bregistra'])) {
    if (!empty($_POST['email']) && !empty($_POST['contrasenya']) && !empty($_POST['contrasenya2']) && !empty($_POST['nom'])
    && !empty($_POST['cognom']) && !empty($_POST['direccio']) && !empty($_POST['poblacio']) && !empty($_POST['codipostal']) 
    && !empty($_FILES['avatar']['tmp_name'])){
        if ($_POST['contrasenya'] != $_POST['contrasenya2']){
            ?>
                <div class="container">
                    <p style="color: red;">Dades no enviades, les contrasenyes no son iguals.</p>
                </div>
            <?php
        }else{
            $email = $_POST['email'];
            $contrasenya = md5($_POST['contrasenya']);
            $nom = $_POST['nom'];
            $cognom = $_POST['cognom'];
            $direccio = $_POST['direccio'];
            $poblacio = $_POST['poblacio'];
            $codipostal = $_POST['codipostal'];
            $admin = 0;
        
            //foto
            $temporal = $_FILES['avatar']['tmp_name'];
            $tipus = $_FILES['avatar']['type'];
    
            $dadesimatge = file_get_contents($temporal);
            $dadesimatge = mysqli_real_escape_string($connexio, $dadesimatge);
    
            //sentencia sql
            $sql = "INSERT INTO `usuari`(`email`, `password`, `nom`, `cognoms`, `direccio`, `poblacio`, `cPostal`,`dadesFoto`,`tipusFoto`,`admin`) 
            VALUES ('$email','$contrasenya','$nom','$cognom','$direccio','$poblacio','$codipostal','$dadesimatge','$tipus','$admin')";
    
            mysqli_query($connexio, $sql);
    
            ?><br>
            <div class="container">
                <p style="color: green; font-size: 20px;">Dades Enviades!</p>
            </div>
            <?php
        }

    } else {
    ?><br>
        <div class="container">
            <p style="color: red; font-size: 20px;">Dades no enviades, algun camp buit.</p>
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
    <link rel="stylesheet" href="../style.css" type="text/css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- Fots awesome -->
    <script src="https://kit.fontawesome.com/9210da3ccb.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../imgs/logo.jpg">
    <title>Log-in botiga virtual</title>
</head>
<body class="bod">
    <div class="banner">
        <img src="../imgs/banner.jpg" alt="">
    </div>
    <div class="container co">
        <h1>Botiga virtual - Sergi Sabater</h1>
        <div class="row">
            <div class="col-md-1">
                <img style="width: 200px;" src="../imgs/nomo.png" alt="">
            </div>
            <div class="col-md-11">
                  <!-- FORMULARI LOG-IN -->
                    <form class="form1" action="sessions.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name ="Lmail" class="form-control" id="" placeholder="Usuari">
                        </div>
                        <div class="form-group">
                            <label for="">Contrasenya</label>
                            <input type="password" name="Lcontrasenya"class="form-control" id="" placeholder="Contrasenya">
                        </div>
                        <input style="color:black; font-weight:bold;" type="submit" class="btn btn-primary" value="Entra" name="Blog"></input>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Registrat</button>        
                    </form>
            </div>
        </div>
      

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registre nou usuari</h4>
            </div>
            <div class="modal-body">
                <!-- FORMULARI REGISTRE -->
                <form class="form2" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" id="" placeholder="jviladoms@jv.cat">
                    </div>
                    <div class="form-group">
                        <label for="">Contrasenya</label>
                        <input type="password" name="contrasenya" class="form-control" id="" placeholder="Contrasenya">
                    </div>
                    <div class="form-group">
                        <label for="">Repeteix Contrasenya</label>
                        <input type="password" name="contrasenya2" class="form-control" id="" placeholder="Repeteix Contrasenya">
                    </div>
                    <div class="form-group">
                        <label for="">Nom</label>
                        <input type="text" name="nom" class="form-control" id="" placeholder="nom">
                    </div>
                    <div class="form-group">
                        <label for="">Cognom</label>
                        <input type="text" name="cognom" class="form-control" id="" placeholder="Cognom">
                    </div> 

                    <div class="form-group">
                        <label for="">Direcció</label>
                        <input type="text" name="direccio" class="form-control" id="" placeholder="Direcció">
                    </div>
                    <div class="form-group">
                        <label for="">Població</label>
                        <input type="text" name="poblacio" class="form-control" id="" placeholder="Població">
                    </div>
                    <div class="form-group">
                        <label for="">Codi Postal</label>
                        <input type="text" name="codipostal" class="form-control" id="" placeholder="08000">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Avatar</label>
                        <input type="file" name="avatar">
                        <p class="help-block">Penja el teu avatar.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tanca</button>
                        <input style="color:black; font-weight:bold;" type="submit" class="btn btn-primary" value="Envia" name="Bregistra"></input>
                    </div>
                </form>

            </div>
           
            </div>
        </div>
        </div>
    </div>
</body>
</html>