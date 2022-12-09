<?php
require_once "DBController.php";
class ShoppingCart extends DBController
{
    function getAllProduct()
    {
        $query = "SELECT * FROM produse";

        $productResult = $this->getDBResult($query);
        return $productResult;
    }

    function getMemberCartItem($id_utilizator)
    {
        $query = "SELECT produse.*, cart.id, cart.cantitate FROM produse, cart WHERE produse.id = cart.id_produs AND cart.id_utilizator = ?";
        $params = array(array(
            "param_type" => "i",
            "param_value" => $id_utilizator
        ));
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function getProductByCode($id_produs)
    {
        $query = "SELECT * FROM produse WHERE id=?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id_produs
            )
        );

        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }

    function getCartItemByProduct($id_produs, $id_utilizator)
    {
        $query = "SELECT * FROM cart WHERE id_produs = ? AND id_utilizator = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id_produs
            ),
            array(
                "param_type" => "i",
                "param_value" => $id_utilizator
            )
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function addToCart($id_produs, $id_utilizator, $cantitate)
    {
        $query = "INSERT INTO cart (id_produs, id_utilizator, cantitate) VALUES (?, ?, ?)";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id_produs
            ),
            array(
                "param_type" => "i",
                "param_value" => $cantitate
            ),
            array(
                "param_type" => "i",
                "param_value" => $id_utilizator
            )
        );

        $this->updateDB($query, $params);
    }

    function updateCartQuantity($cantitate, $id)
    {
        $query = "UPDATE cart SET cantitate = ? WHERE id= ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $cantitate
            ),
            array(
                "param_type" => "i",
                "param_value" => $id
            ));
        $this->updateDB($query, $params);
 }
    function deleteCartItem($id)
    {
        $query = "DELETE FROM cart WHERE id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id
            )
        );

        $this->updateDB($query, $params);
    }
    function emptyCart($id_utilizator)
    {
        $query = "DELETE FROM cart WHERE id_utilizator = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id_utilizator
            )
        );

        $this->updateDB($query, $params);
    }
}