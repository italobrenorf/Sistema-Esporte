<?php
require '../conexao.php';

// Consulta para obter as vendas com o total
$sqlVendas = "SELECT v.idvenda, c.nomecliente, v.data_venda, v.hora_venda, SUM(p.valor * vp.quantidade) as total
              FROM venda v
              JOIN cliente c ON v.idcliente = c.idcliente
              JOIN venda_produto vp ON v.idvenda = vp.idvenda
              JOIN produto p ON vp.idprod = p.idprod
              GROUP BY v.idvenda";

// Executa a consulta
$stmtVendas = $conexao->query($sqlVendas);
$vendas = $stmtVendas->fetchAll();

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
  <h1 class="titulofoda">VENDAS</h1>
  <?php         
    echo "<button class='butao2'><a href='../index.php'>Voltar</a></button>";
  ?>

    <table>
        <thead>
            <tr>
                <th>Produtos</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Total</th>
                <th>ID Venda</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendas as $venda): ?>
                <tr>
                    <td>
                        <?php
                        $sqlProdutos = "SELECT p.nomeprod, vp.quantidade, p.valor
                                        FROM venda_produto vp
                                        JOIN produto p ON vp.idprod = p.idprod
                                        WHERE vp.idvenda = :idvenda";
                        $stmtProdutos = $conexao->prepare($sqlProdutos);
                        $stmtProdutos->bindParam(':idvenda', $venda['idvenda'], PDO::PARAM_INT);
                        $stmtProdutos->execute();
                        $produtos = $stmtProdutos->fetchAll();

                        foreach ($produtos as $produto): ?>
                            <div>
                                <?php echo htmlspecialchars($produto['nomeprod']); ?> - Quantidade: <?php echo htmlspecialchars($produto['quantidade']); ?> - Preço: R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?>
                            </div>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo htmlspecialchars($venda['nomecliente']); ?></td>
                    <td><?php echo htmlspecialchars($venda['data_venda']); ?></td>
                    <td><?php echo htmlspecialchars(date('H:i:s', strtotime($venda['hora_venda']))); ?></td>
                    <td>R$ <?php echo number_format($venda['total'], 2, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($venda['idvenda']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
