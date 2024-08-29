<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<?php
  //incluir arquivo de conexao com o BD
    require_once('../conexao.php');
 
    //armazena id 
    $idprod= $_POST['idprod'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM produto where idprod= :idprod";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':idprod',$idprod, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $nomeprod= $array_retorno ['nomeprod'];
   $tamanho= $array_retorno ['tamanho'];
   $tipo= $array_retorno ['tipo'];
   $genero= $array_retorno ['genero'];
   $valor= $array_retorno ['valor'];
   $marca= $array_retorno ['marca'];
   $urlprod= $array_retorno['urlprod'];
   $idprod= $_POST ['idprod'];
   
?>
 <!-- formulario para cadastrar aluno metodo post, enviar dados para form crudaluno.php -->

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
 <h1 class="titulofoda">ALTERAR PRODUTO</h1>
  <div class="login-2">
  <form method="POST" action="crudproduto.php">
  <h2 class="login">Alterar dados Produto</h2>
       <p> Nome: <input type="text" placeholder="Nome" name="nomeprod" value="<?php echo $nomeprod; ?>" required/> </p> 
       <p> Tamanho: <input type="text" placeholder="Tamanho" name="tamanho" value="<?php echo $tamanho; ?>" required/> </p>
       <p> Tipo: <input type="text" placeholder="Tipo" name="tipo" value="<?php echo $tipo; ?>" required/> </p>
       <p> Gênero: 
       <select name="genero" >
         <option name="Masculino" value="Masculino">Masculino</option>
         <option name="Feminino" value="Feminino" >Feminino</option>
       </select>
       </p>
       <p> Valor: <input type="text" placeholder="Valor" name="valor" value="<?php echo $valor; ?>" required/> </p>
       <p> Marca: 
          <select name="marca">
            <option value="Adidas">Adidas</option>
            <option value="Nike">Nike</option>
            <option value="Puma">Puma</option>
            <option value="Umbro">Umbro</option>
          </select>
        </p>
        <input type="text" id="url" name="urlprod" placeholder="URL" value="<?php echo $urlprod; ?>" required>
           
       <input type="hidden" name="idprod" id="" value="<?php echo $idprod ?>" >
             
       <input id="cadastre" type="submit" name="update" value="Alterar">
       </form>
  </div>
  
</body>
</html>