<?php 

  require_once( '../conexao.php');

  $retorno = $conexao->prepare('SELECT * FROM cliente');

  $retorno->execute();

session_start(); 

if(isset($_SESSION['message'])) {
    echo "<script>alert('".$_SESSION['message']."');</script>";
    unset($_SESSION['message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Cliente</title>
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
 <h1 class="titulofoda">TABELA CLIENTE</h1>
 <?php         
   echo "<button class='butao2'><a href='../index.php'>Voltar</a></button>";
?>
        <table class="tabela"> 
            <thead>
                <tr class="tabela">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Senha</th>
                    <th>ID</th>
                   
                </tr>
            </thead>

            <tbody class="tabela">
                <tr>  
                    <?php foreach($retorno->fetchall() as $value) { ?>
                        <tr>
                            <td> <?php echo $value['nomecliente'] ?>   </td> 
                            <td> <?php echo $value['emailcliente']?>  </td> 
                            <td> <?php echo $value['telefonecliente']?> </td> 
                            <td> <?php echo $value['senhacliente']?> </td> 
                            <td> <?php echo $value['idcliente']?> </td> 
                            <td><!-- codigo para alterar aluno escolhido, enviar via post para o form Altaluno.php -->
                               <form method="POST" action="altcliente.php">
                                        <input name="idcliente" type="hidden" value="<?php echo $value['idcliente'];?>"/>
                                        <button class="butao" name="alterar"  type="submit">Alterar</button>
                                </form>

                             </td> 

                             <td><!-- codigo para excluir aluno escolhido, enviar via get para excluir no crudaluno.php -->
                               <form method="GET" action="crudcliente.php">
                                        <input name="idcliente" type="hidden" value="<?php echo $value['idcliente'];?>"/>
                                        <button  class="butao" name="excluir"  type="submit">Excluir</button>
                                </form>

                             </td> 
                      </tr>
                    <?php  }  ?> 
                 </tr>
            </tbody>
        </table>


</body>
</html>