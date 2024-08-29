  <?php 

    require_once( '../conexao.php');

    $retorno = $conexao->prepare('SELECT * FROM produto');

    $retorno->execute();

  ?>      

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tabela Produto</title>
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
  <h1 class="titulofoda">PRODUTOS</h1>
  <?php         
    echo "<button class='butao2'><a href='../index.php'>Voltar</a></button>";
  ?>

          <table> 
              <thead>
                  <tr>
                      <th>Imagem</th>
                      <th>Nome</th>
                      <th>Tamanho</th>
                      <th>Tipo</th>
                      <th>Gênero</th>
                      <th>Valor</th>
                      <th>Marca</th>
                      <th>ID</th>
                    
                  </tr>
              </thead>

              <tbody>
                  <tr>  
                      <?php foreach($retorno->fetchall() as $value) { ?>

                        <?php $url = $value['urlprod'] ?>
                                                
                          <tr>
                              <td> <?php echo "<img src='$url' height='100px' width='100px'>" ?> </td>
                              <td> <?php echo $value['nomeprod'] ?>  </td>  
                              <td> <?php echo $value['tamanho']?> </td> 
                              <td> <?php echo $value['tipo']?> </td>
                              <td> <?php echo $value['genero']?> </td> 
                              <td> <?php echo $value['valor']?> </td> 
                              <td> <?php echo $value['marca']?> </td>
                              <td> <?php echo $value['idprod']?> </td>    
                              <td><!-- codigo para alterar aluno escolhido, enviar via post para o form Altaluno.php -->
                                <form method="POST" action="altprod.php">
                                          <input name="idprod" type="hidden" value="<?php echo $value['idprod'];?>"/>
                                          <button class="butao" name="alterar"  type="submit">Alterar</button>
                                  </form>

                              </td> 

                              <td><!-- codigo para excluir aluno escolhido, enviar via get para excluir no crudaluno.php -->
                                <form method="GET" action="crudproduto.php">
                                          <input name="idprod" type="hidden" value="<?php echo $value['idprod'];?>"/>
                                          <button class="butao" name="excluir"  type="submit">Excluir</button>
                                  </form>

                              </td> 
                        </tr>
                      <?php  }  ?> 
                  </tr>
              </tbody>
          </table>


  </body>
  </html>