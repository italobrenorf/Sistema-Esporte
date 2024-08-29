<?php
require_once('conexao.php');
require 'Cart.php';
require 'Product.php';

// Buscar produtos do banco de dados
$retorno = $conexao->prepare('SELECT * FROM produto');
$retorno->execute();
$produtos = $retorno->fetchAll(PDO::FETCH_ASSOC);

session_start();

if (isset($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $productInfo = array_filter($produtos, fn($prod) => $prod['idprod'] == $id);
    if ($productInfo) {
        $productInfo = array_pop($productInfo); // Pega o produto filtrado
        $product = new Product;
        $product->setId($productInfo['idprod']);
        $product->setName($productInfo['nomeprod']);
        $product->setPrice($productInfo['valor']);
        $product->setQuantity(1);

        $cart = new Cart;
        $cart->add($product);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esporte</title>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
        <select  class="bt" name="consulta" id="consultalink" class="navegacaolink" onchange="location.href=this.value">
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
      <a href="mycart.php"><img src="./img/carrinho.png" ></a>
      <a href="./cliente/login.php"><img src="./img/login.png" alt="" ></a> 
    </div>
  </header>
  <h1 class="titulofoda">PROMOÇÕES</h1>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
    <div class="swiper-slide"><a href="https://drive.google.com/file/d/1uElA9FKQBPkespMSpFwJMtnVmzevf7Yz/view"><img src="./img/alastor.jpg" alt=""></a></div>
    <div class="swiper-slide"><a href="https://drive.google.com/file/d/1uElA9FKQBPkespMSpFwJMtnVmzevf7Yz/view"><img src="./img/alastor.jpg" alt=""></a></div>
    <div class="swiper-slide"><a href="https://drive.google.com/file/d/1uElA9FKQBPkespMSpFwJMtnVmzevf7Yz/view"><img src="./img/alastor.jpg" alt=""></a></div>
    <div class="swiper-slide"><a href="https://drive.google.com/file/d/1uElA9FKQBPkespMSpFwJMtnVmzevf7Yz/view"><img src="./img/alastor.jpg" alt=""></a></div>
    <div class="swiper-slide"><a href="https://drive.google.com/file/d/1uElA9FKQBPkespMSpFwJMtnVmzevf7Yz/view"><img src="./img/alastor.jpg" alt=""></a></div>
    <div class="swiper-slide"><a href="https://drive.google.com/file/d/1uElA9FKQBPkespMSpFwJMtnVmzevf7Yz/view"><img src="./img/alastor.jpg" alt=""></a></div>
    </div>
    <div class="swiper-button-next" style="color: red;"></div>
    <div class="swiper-button-prev" style="color: red;"></div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {q
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

<h1 class="titulofoda">PRODUTOS</h1>
<div class="ofertas">
    <?php
    // Limita a 4 produtos
    $produtosLimitados = array_slice($produtos, 0, 4);

    if (empty($produtosLimitados)) : ?>
        <p>Nenhum produto disponível.</p>
    <?php else : ?>
        <?php foreach ($produtosLimitados as $produto) : ?>
            <div class="produto2">
                <img style="height: 175px;" src="<?php echo htmlspecialchars($produto['urlprod']); ?>" alt="<?php echo htmlspecialchars($produto['nomeprod']); ?>">
                <h3><?php echo htmlspecialchars($produto['nomeprod']); ?></h3>
                <p>Valor: R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>
                <a class="add" href="?id=<?php echo $produto['idprod']; ?>">Adicionar ao Carrinho</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>




  <h1 class="titulofoda">MARCAS</h1>
  <div class="marcas">
  <div class="marca1">
    <a href="./marcas/adidas.php"><img src="./img/adidaslogo.png" height="75px"></a>
  </div>
  <div class="marca2">
  <a href="./marcas/nike.php"><img src="./img/nikelogo.png" height="75px"></a> 
  </div>
  <div class="marca3">
  <a href="./marcas/puma.php"><img src="./img/pumalogo.png" height="250px"></a>  
  </div>
  <div class="marca4">
  <a href="./marcas/umbro.php"><img src="./img/umbrologo.png" height="100px"></a>   
  </div>
  </div>

  <footer>
  <div class="ajuda">Ajuda e Atendimento</div>
  <div class="pag">Pagamento</div>
  <div class="redes">Redes sociais</div>
  </footer>

</body>
</html>
