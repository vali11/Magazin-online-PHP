<?php
include("conectare.php");
echo "</br>";
$error = '';
if (isset($_POST['register'])) {
    $id = NULL;
    $username = htmlentities($_POST['username'], ENT_QUOTES);
    $parola = htmlentities($_POST['parola'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
    $strada = htmlentities($_POST['strada'], ENT_QUOTES);
    $numar = htmlentities($_POST['numar'], ENT_QUOTES);
    $cod_postal = htmlentities($_POST['cod_postal'], ENT_QUOTES);
    $oras = htmlentities($_POST['oras'], ENT_QUOTES);
    

    if (mysqli_connect_errno()) {
        exit('Nu se poate conecta la MySQL: ' . mysqli_connect_error());
    }
    if (empty($username) || empty($parola) || empty($email)) {
        exit('Va rugam sa completati toate datele.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('Email-ul nu este valid.');
    }
    if (preg_match('/[A-Za-z0-9]+/', $username) == 0) {
        exit('Username nu este valid!');
    }
    if (strlen($parola) > 20 || strlen($parola) < 5) {
        exit('Parola trebuie sa fie intre 5 si 20 charactere!');
    }
// verificam daca contul userului exista.
    if ($stmt = $mysqli->prepare('SELECT id, parola FROM utilizatori WHERE username = ?')) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo 'Username exists, alegeti altul!';
        } 
        else{
                if ($stmt = $mysqli->prepare('INSERT INTO utilizatori (id, email, username, parola, nume, prenume, strada, numar, cod_postal, oras ) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
                    $password = password_hash($parola, PASSWORD_DEFAULT);
                    $stmt->bind_param('isssssssss', $id, $email, $username, $password, $nume, $prenume, $strada, $numar, $cod_postal, $oras);
                    $stmt->execute();
                    $stmt->close();
                    header('Location: index.html');
                } else {
                    echo 'Nu se poate face prepare statement!';
                }
            }
        
    }
}
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inregistrare</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="formstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="register">
    <h1><?php echo "Inserare inregistrare"; ?></h1>
    <?php if (!empty($error))
    {
        echo "<div style='padding:4px'; border:1px solid red; color:red'>".$error."</div>";
    } ?>
    <form action="Inregistrare.php" method="post" autocomplete="off">
        <label for="nume_user">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" placeholder="Username" id="nume_user" required>
        <label for="parola">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="parola" placeholder="Parola" id="parola" required>
        <label for="email">
            <i class="fas fa-envelope"></i>
        </label>
        <input type="email" name="email" placeholder="Email" id="email" required>
        <input type="text" name="nume" placeholder="Nume" id="nume" required>
        <input type="text" name="prenume" placeholder="Prenume" id="prenume" required>
        <input type="text" name="strada" placeholder="Strada" id="strada" required>
        <input type="text" name="numar" placeholder="Numar" id="numar" required>
        <input type="text" name="cod_postal" placeholder="Cod postal" id="cod_postal" required>
        <input type="text" name="oras" placeholder="Oras" id="oras" required>
        <input type="submit" name="register" value="Register">
    </form>
    <a href="index.html">Login</a>
</div>
</body>
</html>