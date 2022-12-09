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

if ($result = $mysqli->query("SELECT * FROM produse ORDER BY id "))
{ 
if ($result->num_rows > 0)
{
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Denumire</th><th>Categorie</th><th>Descriere</th><th>Pret</th><th>Imagine</th><th></th><th></th></tr>";
while ($row = $result->fetch_object())
{
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->denumire . "</td>";
echo "<td>" . $row->indicativ_categorie . "</td>";
echo "<td>" . $row->descriere . "</td>";
echo "<td>" . $row->pret . "</td>";
echo "<td>" . $row->imagine . "</td>";
echo "<td><a class='modificare' href='modificare.php?id=" . $row->id . "'>Modificare</a></td>";
echo "<td><a class='stergere' href='stergere.php?id=" .$row->id . "'>Stergere</a></td>";
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
  <a href="inserare.php">Inserati o noua inregistrare</a>
  <a href="vizualizare_useri.php">Tabela utilizatori</a>
  <a href="magazin.php">Vizualizare magazin</a>
  <a href="deconectare.php">Logout</a>
</div>
</body>
</html>
