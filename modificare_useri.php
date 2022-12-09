<?php 
include("conectare.php");
$error='';
if (!empty($_POST['id'])){ 
    if (isset($_POST['submit'])){ 
        if (is_numeric($_POST['id'])){ // 
            $id = $_POST['id'];
            $email = htmlentities($_POST['email'], ENT_QUOTES);
            $username = htmlentities($_POST['username'], ENT_QUOTES);
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
            $strada = htmlentities($_POST['strada'], ENT_QUOTES);
            $numar = htmlentities($_POST['numar'], ENT_QUOTES);
            $cod_postal = htmlentities($_POST['cod_postal'], ENT_QUOTES);
            $oras = htmlentities($_POST['oras'], ENT_QUOTES);


            if ($email == '' || $nume == ''||$prenume==''||$strada==''||$numar==''||$cod_postal==''||$oras==''||$username==''){ 
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            }
            else { 
                if ($stmt = $mysqli->prepare("UPDATE utilizatori SET email=?,username=?,nume=?,prenume=?,strada=?,numar=?,cod_postal=?,oras=? WHERE id='".$id."'")){
$stmt->bind_param("ssssssss", $email,$username, $nume, $prenume, $strada, $numar,$cod_postal,$oras);
$stmt->execute();
$stmt->close();
 }
else
{echo "ERROR: nu se poate executa update.";}
}
}

else
{echo "id incorect!";} }}?>
<html> 
    <head>
        <title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
        <link href="formstyle.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>

        <?php if ($error != '') {
            echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
        <form action="" method="post">
            <div>
            <?php if ($_GET['id'] != '') { ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
            <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM utilizatori where id='".$_GET['id']."'")){
                if ($result->num_rows > 0){ 
                    $row = $result->fetch_object();?></p>
<strong>Email: </strong> <input type="email" name="email" value="<?php echo $row->email; ?>"/><br/>
<strong>Username: </strong> <input type="text" name="username" value="<?php echo $row->username; ?>"/><br/>
<strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->nume; ?>"/><br/>
<strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo $row->prenume; ?>"/><br/>
<strong>Strada: </strong> <input type="text" name="strada" value="<?php echo $row->strada; ?>"/><br/>
<strong>Numar: </strong> <input type="text" name="numar" value="<?php echo $row->numar; ?>"/><br/>
<strong>Cod postal: </strong> <input type="text" name="cod_postal" value="<?php echo $row->cod_postal; ?>"/><br/>
<strong>Oras: </strong> <input type="text" name="oras" value="<?php echo $row->oras;}}}?>"/><br/>
<br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="vizualizare_useri.php">Inapoi la tabela utilizatori</a>
</div></form></body> </html>