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
    $idcliente= $_POST['idcliente'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM cliente where idcliente= :idcliente";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':idcliente',$idcliente, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $nomecli= $array_retorno ['nomecliente'];
   $emailcli= $array_retorno['emailcliente'];
   $telefonecli= $array_retorno['telefonecliente'];
   $senhacli= $array_retorno['senhacliente'];
   
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
 <h1 class="titulofoda">ALTERAR CLIENTE</h1>
      <div class="login-2">
      <form class="" method="POST" action="crudcliente.php">
      <h2 class="login">Alterar dados Cliente</h2>
       
       <p> Nome: <input type="text" placeholder="Nome" name="nomecliente" value="<?php echo $nomecli; ?>" required/> </p> 
       <p> E-mail: <input type="text" placeholder="E-mail" name="emailcliente" value="<?php echo $emailcli; ?>" required/> </p>
       <p> Telefone: <input type="text" placeholder="Telefone" name="telefonecliente" value="<?php echo $telefonecli; ?>" required/> </p>
       <p> Senha: <input type="text" placeholder="Senha" name="senhacliente" value="<?php echo $senhacli; ?>" required/> </p>
           
             <input type="hidden" name="idcliente" id="" value="<?php echo $idcliente ?>" >
             
             <input id="cadastre"type="submit" name="update" value="Alterar">
       </form>
      </div>
  
</body>
</html>