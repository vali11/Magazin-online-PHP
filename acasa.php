<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pagina HOME</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>MAGAZIN TESATURI</h1>
        <a href="index.html"><i class="fas fa-sign-outalt"></i>Logout</a>
        <a href="magazin.php"><i class="fas fa-shopping-cart"></i>Vezi produse</a>
        <a href="cos.php">Vezi Cos</a>
    </div>
</nav>
<div class="content">
    <p><h2>Bine ati revenit, <?=$_SESSION['name']?>!<h2></p>
</div>
</body>
</html>
