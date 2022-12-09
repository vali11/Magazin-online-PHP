<?php 
include("conectare.php");
$error='';
if (!empty($_POST['id'])){ 
    if (isset($_POST['submit'])){ 
        if (is_numeric($_POST['id'])){ // 
            $id = $_POST['id'];
            $denumire = htmlentities($_POST['denumire'], ENT_QUOTES);
            $indicativ_categorie = htmlentities($_POST['indicativ_categorie'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
            $pret = htmlentities($_POST['pret'], ENT_QUOTES);
            $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);


            if ($denumire == '' || $indicativ_categorie == ''||$descriere==''||$pret==''||$imagine==''){ 
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            }
            else { 
                if ($stmt = $mysqli->prepare("UPDATE produse SET denumire=?,indicativ_categorie=?,descriere=?,pret=?,imagine=? WHERE id='".$id."'")){
$stmt->bind_param("sssds", $denumire, $indicativ_categorie, $descriere, $pret, $imagine);
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
            if ($result = $mysqli->query("SELECT * FROM produse where id='".$_GET['id']."'")){
                if ($result->num_rows > 0){ 
                    $row = $result->fetch_object();?></p>
<strong>Denumire: </strong> <input type="text" name="denumire" value="<?php echo $row->denumire; ?>"/><br/>
<strong>Indicativ categorie: </strong> <input type="text" name="indicativ_categorie" value="<?php echo $row->indicativ_categorie; ?>"/><br/>
<strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->descriere; ?>"/><br/>
<strong>Pret: </strong> <input type="text" name="pret" value="<?php echo $row->pret; ?>"/><br/>
<strong>Imagine: </strong> <input type="text" name="imagine" value="<?php echo $row->imagine;}}}?>"/><br/>
<br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="vizualizare.php">Index</a>
</div></form></body> </html>