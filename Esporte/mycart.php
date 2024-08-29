<?php
require 'Product.php';
require 'Cart.php';
require_once('conexao.php');

$retorno = $conexao->prepare('SELECT * FROM produto');

$retorno->execute();

session_start();

$cart = new Cart;
$productsInCart = $cart->getCart();

if (isset($_GET['remove'])) {
    $id = strip_tags($_GET['remove']);
    $cart->remove($id);
    header('Location: mycart.php');
    exit;
}

if (isset($_GET['update'])) {
    $id = strip_tags($_GET['update']);
    $qty = strip_tags($_GET['qty']);
    $cart->updateQty($id, $qty);
    header('Location: mycart.php');
    exit;
}

date_default_timezone_set('America/Bahia');

// Inserção da venda na tabela
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcliente = $_POST['idcliente'];
    $dataVenda = date('Y-m-d');
    $horaVenda = date('H:i:s');

    $sqlVenda = "INSERT INTO venda (idcliente, data_venda, hora_venda) VALUES (:idcliente, :dataVenda, :horaVenda)";
    $stmtVenda = $conexao->prepare($sqlVenda);
    $stmtVenda->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
    $stmtVenda->bindParam(':dataVenda', $dataVenda, PDO::PARAM_STR);
    $stmtVenda->bindParam(':horaVenda', $horaVenda, PDO::PARAM_STR);

    if ($stmtVenda->execute()) {
        $idvenda = $conexao->lastInsertId();

        foreach ($productsInCart as $product) {
            $idprod = $product->getId();
            $quantidade = $product->getQuantity();

            $sqlVendaProduto = "INSERT INTO venda_produto (idvenda, idprod, quantidade) VALUES (:idvenda, :idprod, :quantidade)";
            $stmtVendaProduto = $conexao->prepare($sqlVendaProduto);
            $stmtVendaProduto->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
            $stmtVendaProduto->bindParam(':idprod', $idprod, PDO::PARAM_INT);
            $stmtVendaProduto->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmtVendaProduto->execute();
        }

        // Limpar o carrinho após a venda
        $cart->clear();

        // Redirecionar para a página da tabela de vendas
        header('Location: vendas/tabelavenda.php');
        exit;
    } else {
        echo "Erro ao registrar a venda.";
    }
}

// Recuperar a lista de clientes para seleção
$sqlClientes = "SELECT idcliente, nomecliente FROM cliente";
$stmtClientes = $conexao->prepare($sqlClientes);
$stmtClientes->execute();
$clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho</title>
    <link rel="stylesheet" href="./css/carrinho.css">
</head>
<body>
<header>
    <img class="foto" src="./img/1721697669367.png" alt="" />

    <ul class="navegacao">
    <li>
        <a href="index.php" class="navegacaolink">Home</a>
    </li>
    <li>
        <a href="./php/futebol.php" class="navegacaolink">Futebol</a>
    </li>
    <li>
        <a href="./php/volei.php" class="navegacaolink">Volei</a>
    </li>
    <li>
        <a href="./php/handebol.php" class="navegacaolink">Handebol</a>
    </li>
    <li>
        <a href="./php/basquete.php" class="navegacaolink">Basquete</a>
    </li>
    <li>
        <select class="bt" name="consulta" id="consultalink" class="navegacaolink" onchange="location.href=this.value">
        <option value="" selected hidden>Consultar</option>
        <option value="./cliente/tabelacliente.php">Clientes</option>
        <option value="./produto/tabelaproduto.php">Produtos</option>
        <option value="./vendas/tabelavenda.php">Vendas</option>
        </select>
    </li>
    <li>
        <select class="bt" name="cadastro" id="cadastrolink" class="navegacaolink" onchange="location.href=this.value">
        <option value="" selected hidden>Cadastrar</option>
        <option value="./cliente/cadcliente.php">Clientes</option>
        <option value="./produto/cadproduto.php">Produtos</option>
        </select>
    </li>
    </ul>

<div class="social">
    <a href="./mycart.php"><img src="./img/carrinho.png"></a>
    <a href="./cliente/login.php"><img src="./img/login.png" alt=""></a> 
    
</div>
</header>

<?php         
    echo "<button class='butao2'><a href='index.php'>Voltar</a></button>";
?>

<ul class="form">
    <?php if (count($productsInCart) <= 0) : ?>
        <li>Nenhum produto no carrinho</li>
    <?php else: ?>
        <?php foreach ($productsInCart as $product) : ?>
            <li class="tilt">
                <p><?php echo htmlspecialchars($product->getName()); ?></p>
                <form action="" method="get">
                    <input type="hidden" name="update" value="<?php echo $product->getId(); ?>">
                    <input type="number" name="qty" value="<?php echo $product->getQuantity() ?>" min="1">
                    <input class="update" type="submit" value="Atualizar">
                </form>
                <p>Preço: R$ <?php echo number_format($product->getPrice(), 2, ',', '.') ?> </p>
                <p>Subtotal: R$ <?php echo number_format($product->getPrice() * $product->getQuantity(), 2, ',', '.') ?></p>
                <a class="remove" href="?remove=<?php echo $product->getId(); ?>">Remover</a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
    <li class="total">Total: R$ <?php echo number_format($cart->getTotal(), 2, ',', '.'); ?></li>
</ul>

<form class="form2" method="post" action="">
    <label for="idcliente">Selecione o Cliente:</label>
    <select name="idcliente" id="idcliente" required>
        <?php foreach ($clientes as $cliente) : ?>
            <option value="<?php echo $cliente['idcliente']; ?>"><?php echo $cliente['nomecliente']; ?></option>
        <?php endforeach; ?>
    </select>
    <button class="butao" type="submit">Finalizar Compra</button>
</form>

</body>
</html>