<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handebol</title>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    <div id="background">
        <figure>
          <img src="../img/fundo2.jpeg" width="100%"/>
        </figure>
      </div>
      <header>
        <img class = "foto" src="../img/1721697669367.png" alt="" />
    
        <ul class="navegacao">
          <li>
           <a href="../index.php" class="navegacaolink">Home</a>
          </li>
          <li>
           <a href="futebol.php" class="navegacaolink">Futebol</a>
          </li>
          <li>
            <a href="volei.php" class="navegacaolink">Volei</a>
           </li>
          <li>
           <a href="handebol.php" class="navegacaolink">Handebol</a>
          </li>
          <li>
           <a href="basquete.php" class="navegacaolink">Basquete</a>
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
        <select  class="bt"name="cadastro" id="cadastrolink" class="navegacaolink" onchange="location.href=this.value">
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
     <footer>
  <div class="ajuda">Ajuda e Atendimento</div>
  <div class="pag">Pagamento</div>
  <div class="redes">Redes sociais</div>
  </footer>

</body>
</html>