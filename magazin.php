<?php
require_once "ShoppingCart.php";?>
<HTML>
<HEAD>
    <TITLE>Creare cos cumparaturi </TITLE>
  <style>
@media only screen and (max-width:1000 px){
  .menu, .main, .right{
      width:100%;
      display: block;
      margin-bottom: 20px;
    }
  }
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

.row {margin: 0 -5px;}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.price {
  color: grey;
  font-size: 22px;
}

.adauga, .cantitate {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

::placeholder{
  color: white;
}

.adauga:hover {
  opacity: 0.7;
}

</style>
</HEAD>
<BODY>
<div class="header">
    <span style="text-align:center"><h1>Produsele Noastre<h1></span>
</div>
<div id="product-grid">
    <?php
    $shoppingCart = new ShoppingCart();
    $query = "SELECT * FROM produse";
    $product_array = $shoppingCart->getAllProduct($query);
    if (! empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ?>
            
            <div class="column">
            <div class="card">
            <form method="post" action="cos.php?action=add&id_produs=<?php echo $product_array[$key]["id"]; ?>">
                <img width="300px" height="300px"  src="<?php echo 'imagini/'.$product_array[$key]["imagine"]; ?>" style="width:100%">
                <h1><?php echo $product_array[$key]["denumire"]; ?></h1>
                <p class="price"><?php echo $product_array[$key]["pret"]." lei"; ?></p>
                <input type="number" class="cantitate" name="quantity" size="2" min="1" max="100" placeholder="Cantitate" required/>
                <input type="submit" class="adauga" value="Adauga in cos" class="btnAddAction" />
               
            </form>
            </div>
            </div>
            

            <?php
        }
    }
    ?>
</div>
</BODY>
</HTML>