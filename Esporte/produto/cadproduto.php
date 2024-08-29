<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="../css/login.css">
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
 <h1 class="titulofoda">CADASTRAR PRODUTO</h1>
  <div class="login-2">
    <form action="crudproduto.php" method="post">

        <p> Nome: <input type="text" placeholder="Nome" name="nomeprod" required/> </p> 
        <p> Tamanho: <input type="text" placeholder="Tamanho" name="tamanho"required/> </p>
        <p> Tipo: <input type="text" placeholder="Tipo" name="tipo"required/> </p>
        <p> Gênero: 
          <select class="bt" name="genero" >
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
          </select>
        </p>
        <p> Valor: <input type="number" step="0.01" placeholder="Valor" name="valor" required/> </p>
        <p> Marca: 
          <select class="bt2" name="marca">
            <option value="Adidas">Adidas</option>
            <option value="Nike">Nike</option>
            <option value="Puma">Puma</option>
            <option value="Umbro">Umbro</option>
          </select>
        </p>
        <input type="text" id="url" name="urlprod" placeholder="URL" required>
        <input id="cadastre" type="submit" name="cadastrar" value="Cadastrar">
    </form>
  </div>
</body>
</html>
