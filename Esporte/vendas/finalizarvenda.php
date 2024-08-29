<?php

require 'Product.php';
require 'Cart.php';
require_once 'conexao.php';

session_start();

$cart = new Cart;
$productsInCart = $cart->getCart();
$idcliente = $_POST['idcliente'];

if (count($productsInCart) > 0 && $idcliente) {
    // Registrar venda
    $stmt = $conexao->prepare("INSERT INTO venda (idcliente, data_venda, hora_venda) VALUES (:idcliente, CURDATE(), CURTIME())");
    $stmt->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
    $stmt->execute();
    $idvenda = $conexao->lastInsertId();

    // Registrar os produtos na venda
    foreach ($productsInCart as $product) {
        $stmt = $conexao->prepare("INSERT INTO venda_produto (idvenda, idprod, quantidade) VALUES (:idvenda, :idprod, :quantidade)");
        $stmt->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
        $stmt->bindParam(':idprod', $product->getId(), PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $product->getQuantity(), PDO::PARAM_INT);
        $stmt->execute();
    }

    // Esvaziar carrinho
    $cart->clear();

    echo "<p>Venda finalizada com sucesso!</p>";
    echo "<a href='index.php'>Voltar para a Home</a>";
} else {
    echo "<p>Erro ao finalizar a venda. Certifique-se de que o carrinho não esteja vazio e um cliente esteja selecionado.</p>";
    echo "<a href='mycart.php'>Voltar para o Carrinho</a>";
}
?>
