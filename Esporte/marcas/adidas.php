<?php
require_once('../conexao.php');
require_once('../Product.php');
require_once('../Cart.php');

session_start();

$marca = 'Adidas'; // Pode ser parametrizado para outras marcas

$sql = "SELECT * FROM produto WHERE marca = :marca";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
$stmt->execute();
$produtos = $stmt->fetchAll();

if (isset($_POST['add_to_cart'])) {
    $product = new Product();
    $product->setId($_POST['idprod']);
    $product->setName($_POST['nomeprod']);
    $product->setPrice($_POST['valor']);
    $product->setQuantity(1); // Quantidade inicial

    $cart = new Cart();
    $cart->add($product);

    header("Location: {$marca}.php"); // Redireciona para a página da marca correta
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos <?php echo $marca; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <img class = "foto" src="../img/1721697669367.png" alt="" />

    <ul class="navegacao">
      <li>
       <a href="../index.php" class="navegacaolink">Home</a>
      </li>
      <li>
       <a href="../php/futebol.php" class="navegacaolink">Futebol</a>
      </li>
      <li>
        <a href="../php/volei.php" class="navegacaolink">Volei</a>
       </li>
      <li>
       <a href="../php/handebol.php" class="navegacaolink">Handebol</a>
      </li>
      <li>
       <a href="../php/basquete.php" class="navegacaolink">Basquete</a>
      </li>
      <li>
        <select class="bt" name="consulta" id="consultalink" class="navegacaolink" onchange="location.href=this.value">
        <option value="" selected hidden>Consultar</option>
        <option value="../cliente/tabelacliente.php">Clientes</option>
        <option value="../produto/tabelaproduto.php">Produtos</option>
        <option value="../vendas/tabelavenda.php">Vendas</option>
        </select>
      </li>
      <li>
        <select class="bt" name="cadastro" id="cadastrolink" class="navegacaolink" onchange="location.href=this.value">
        <option value="" selected hidden>Cadastrar</option>
        <option value="../cliente/cadcliente.php">Clientes</option>
        <option value="../produto/cadproduto.php">Produtos</option>
        </select>
      </li>
   </ul>


   <div class="social">
   <a href="../mycart.php"><img src="../img/carrinho.png" ></a>
   <a href="../cliente/login.php"><img src="../img/login.png" alt="" ></a> 
   
 </div>
 </header>
 <h1 class="titulofoda">Produtos <?php echo $marca; ?></h1>
  <div class="product-list">

    <?php if (empty($produtos)) : ?>
        <p>Nenhum produto disponível.</p>
    <?php else : ?>
        <?php foreach ($produtos as $produto) : ?>
            <div class="produto">
                <img style="height: 175px;" src="<?php echo htmlspecialchars($produto['urlprod']); ?>" alt="<?php echo htmlspecialchars($produto['nomeprod']); ?>">
                <h3><?php echo htmlspecialchars($produto['nomeprod']); ?></h3>
                <p>Tamanho: <?php echo htmlspecialchars($produto['tamanho']); ?></p>
                <p>Tipo: <?php echo htmlspecialchars($produto['tipo']); ?></p>
                <p>Gênero: <?php echo htmlspecialchars($produto['genero']); ?></p>
                <p>Valor: R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>
                <form action="<?php echo $marca; ?>.php" method="post">
                    <input type="hidden" name="idprod" value="<?php echo $produto['idprod']; ?>">
                    <input type="hidden" name="nomeprod" value="<?php echo $produto['nomeprod']; ?>">
                    <input type="hidden" name="valor" value="<?php echo $produto['valor']; ?>">
                    <button id="butao" type="submit" name="add_to_cart">Adicionar ao carrinho</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <footer>
  <div class="ajuda">Ajuda e Atendimento</div>
  <div class="pag">Pagamento</div>
  <div class="redes">Redes sociais</div>
  </footer>

</body>
</html>
