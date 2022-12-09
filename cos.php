<?php
require_once "ShoppingCart.php";
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$id_utilizator=$_SESSION['id'];
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {
                $productResult = $shoppingCart->getProductByCode($_GET["id_produs"]);
                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $id_utilizator);
                if (! empty($cartResult)) {
                    $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $id_utilizator);
                }
            }
            break;
        case "remove":
            $shoppingCart->deleteCartItem($_GET["id_produs"]);
            break;
        case "empty":
            $shoppingCart->emptyCart($id_utilizator);
            break;
    }
}
?>
<HTML>
<HEAD>
    <TITLE>creare cos permament in PHP</TITLE>
</HEAD>
<BODY>
<div id="shopping-cart">
    <div class="txt-heading">
        <h1 class="txt-heading-label">Cos Cumparaturi</h1> 
        <h2 class="Action"><a id="btnEmpty" href="cos.php?action=empty">Goleste cos</a></h2>
    </div>
    <?php
    $cartItem = $shoppingCart->getMemberCartItem($id_utilizator);
    if (! empty($cartItem)) {
        $item_total = 0;
        ?>
        <table cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align: left;"><strong>Denumire produs</strong></th>
                <th style="text-align: left;"><strong>Descriere</strong></th>
                <th style="text-align:right;"><strong>Cantitate</strong></th>
                <th style="text-align:right;"><strong>Pret</strong></th>
                <th style="text-align:center;"><strong>Action</strong></th>
            </tr>
            <?php
            foreach ($cartItem as $item) {
                ?>
                <tr>
                    <td
                            style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["denumire"]; ?></strong></td>
                    <td
                            style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["descriere"]; ?></td>
                    <td
                            style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cantitate"]; ?></td>
                    <td
                            style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["pret"]; ?></td>
                    <td
                            style="text-align: center; border-bottom: #F0F0F0 1px solid;"><a href="cos.php?action=remove&id_produs=<?php echo $item["id"]; ?>" class="btnRemoveAction"><img width="20px" height="20px" src="imagini\delete-icon.png" alt="icon-delete" title="Remove Item" /></a></td>
                </tr>
                <?php
                $item_total += ($item["pret"] * $item["cantitate"]);
            }
            ?>
            <tr>
                <td colspan="3"
                    align=right><strong>Total:</strong></td>
                <td align=right><?php echo $item_total." lei"; ?></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        
        <?php
    }
    else{
            echo '<div> <img src="imagini\empty-cart.jpeg" alt="empty-cart" title="Empty Cart" /></div>';
    }
    ?>
</div>
<div><a href="magazin.php">Alegeti alt produs</a></div>
<div><a href="deconectare.php">Abandonati sesiunea de cumparare</a></div>
<?php //require_once "product-list.php"; ?>

</BODY>
</HTML>