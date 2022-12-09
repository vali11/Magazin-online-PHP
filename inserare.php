<?php
include("conectare.php");
$error='';
if (isset($_POST['submit']))
{
    // preluam datele de pe formular
    $id = NULL;
    $denumire = htmlentities($_POST['denumire'], ENT_QUOTES);
    $indicativ_categorie = htmlentities($_POST['indicativ_categorie'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $pret = htmlentities($_POST['pret'], ENT_QUOTES);
    $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);

    // verificam daca sunt completate
    if($denumire == '' || $indicativ_categorie == ''||$descriere==''||$pret==''||$imagine=='')
    {
        // daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
        // insert
        if ($stmt = $mysqli->prepare("INSERT into produse (id, denumire, indicativ_categorie, descriere, pret, imagine) VALUES (?, ?, ?, ?, ?, ?)"))
        {
            $stmt->bind_param("isssds", $id, $denumire, $indicativ_categorie, $descriere, $pret, $imagine);
            $stmt->execute();
            $stmt->close();
        }
        // eroare le inserare
        else
        {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
// se inchide conexiune mysqli
$mysqli->close();
?>

<!DOCTYPE HTML PUBLIC "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title><?php echo "Inserare inregistrare"; ?> </title>
    <link href="formstyle.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if (!empty($error))
{
    echo "<div style='padding:4px'; border:1px solid red; color:red'>".$error."</div>";
} ?>
<form action="" method="post">
    <div>
        <strong>Denumire: </strong> <input type="text" name="denumire" value=""/><br/>
        <strong>Indicativ categorie: </strong> <input type="text" name="indicativ_categorie" value=""/><br/>
        <strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
        <strong>Pret: </strong> <input type="text" name="pret" value=""/><br/>
        <strong>Imagine: </strong> <input type="text" name="imagine" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit"/>
        <a href="vizualizare.php">Index</a>
    </div>
</form>
</body>
</html>