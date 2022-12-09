<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Vizualizare Inregistrari</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>

.topnav {
  background-color: #000066;
  overflow: hidden;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}


.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
<h1>Inregistrarile din tabela produse</h1>
<p><b>Toate inregistrarile din produse</b</p>
</br>
<?php

include("conectare.php");

if ($result = $mysqli->query("SELECT * FROM utilizatori ORDER BY id "))
{ 
if ($result->num_rows > 0)
{
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Email</th><th>Username</th><th>Nume</th><th>Prenume</th><th>Strada</th><th>Numar</th><th>Cod postal</th><th>Oras</th><th></th><th></th></tr>";
while ($row = $result->fetch_object())
{
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->email . "</td>";
echo "<td>" . $row->username . "</td>";
echo "<td>" . $row->nume . "</td>";
echo "<td>" . $row->prenume . "</td>";
echo "<td>" . $row->strada. "</td>";
echo "<td>" . $row->numar . "</td>";
echo "<td>" . $row->cod_postal . "</td>";
echo "<td>" . $row->oras . "</td>";
echo "<td><a class='modificare' href='modificare_useri.php?id=" . $row->id . "'>Modificare</a></td>";
echo "<td><a class='stergere' href='stergere_useri.php?id=" .$row->id . "'>Stergere</a></td>";
echo "</tr>";
}
echo "</table>";
}
else
{
echo "Nu sunt inregistrari in tabela!";
}
}
else
{ echo "Error: " . $mysqli->error(); }
$mysqli->close();
?>
<div class="topnav">
  <a href="vizualizare.php">Tabela produse</a>
  <a href="deconectare.php">Logout</a>
</div>
</body>
</html>