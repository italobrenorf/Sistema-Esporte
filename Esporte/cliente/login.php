<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
   
 </div>
 </header>
 <h1 class="titulofoda">LOGIN</h1>
  <div class="login">
    <div class="login-2">
   
      <form action="../index.php">
       <h2 class="login">Login</h2>
       <p> E-mail: <input type="text"placeholder="E-mail:" name="email" required/> </p> 
       <p> Senha: <input type="text" placeholder="senha:" name="Senha" required/> </p> 
       <p id="cadastre2">Não tem uma conta? <a href="cadcliente.php"> <span id="cad-aqui">Cadastre-se aqui</span></a></p>
       <input id="cadastre" type="submit" value="Enviar">
      </form>
   </div>
  </div>
 
</body>
</html>