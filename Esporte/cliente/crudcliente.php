<?php 

require_once('../conexao.php');
session_start(); // Inicie a sessão

if(isset($_POST['cadastrar'])){

    $nomecli = $_POST['nomecliente'];
    $emailcli = $_POST['emailcliente'];
    $telefonecli = $_POST['telefonecliente'];
    $senhacli = $_POST['senhacliente'];

    $sql = "INSERT INTO cliente(nomecliente, emailcliente, telefonecliente, senhacliente) VALUES (:nomecliente, :emailcliente, :telefonecliente, :senhacliente)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':nomecliente', $nomecli, PDO::PARAM_STR);
    $stmt->bindParam(':emailcliente', $emailcli, PDO::PARAM_STR);
    $stmt->bindParam(':telefonecliente', $telefonecli, PDO::PARAM_STR);
    $stmt->bindParam(':senhacliente', $senhacli, PDO::PARAM_STR);

    if($stmt->execute()) {
        $_SESSION['message'] = "Cliente $nomecli foi registrado com sucesso!";
        header("Location: tabelacliente.php");
        exit();
    } else {
        $_SESSION['message'] = "O cliente não foi registrado.";
        header("Location: tabelacliente.php");
        exit();
    }
}

if(isset($_POST['update'])){

    $nomecli = $_POST['nomecliente'];
    $emailcli = $_POST['emailcliente'];
    $telefonecli = $_POST['telefonecliente'];
    $senhacli = $_POST['senhacliente'];
    $idcliente = $_POST['idcliente'];

    $sql = "UPDATE cliente SET nomecliente= :nomecliente, emailcliente= :emailcliente, telefonecliente= :telefonecliente, senhacliente= :senhacliente WHERE idcliente= :idcliente";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':nomecliente', $nomecli, PDO::PARAM_STR);
    $stmt->bindParam(':emailcliente', $emailcli, PDO::PARAM_STR);
    $stmt->bindParam(':telefonecliente', $telefonecli, PDO::PARAM_STR);
    $stmt->bindParam(':senhacliente', $senhacli, PDO::PARAM_STR);
    $stmt->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);

    if($stmt->execute()) {
        $_SESSION['message'] = "Cliente $nomecli foi atualizado com sucesso!";
        header("Location: tabelacliente.php");
        exit();
    } else {
        $_SESSION['message'] = "A alteração do cliente falhou.";
        header("Location: tabelacliente.php");
        exit();
    }
}

if(isset($_GET['excluir'])){
    if(isset($_GET['idcliente'])){
        $idcliente = $_GET['idcliente'];

        // Exclua todos os produtos associados às vendas deste cliente
        $sqlVendaProduto = "DELETE vp FROM venda_produto vp 
                            JOIN venda v ON vp.idvenda = v.idvenda 
                            WHERE v.idcliente = :idcliente";
        $stmtVendaProduto = $conexao->prepare($sqlVendaProduto);
        $stmtVendaProduto->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
        $stmtVendaProduto->execute();

        // Exclua todas as vendas associadas a este cliente
        $sqlVendas = "DELETE FROM venda WHERE idcliente = :idcliente";
        $stmtVendas = $conexao->prepare($sqlVendas);
        $stmtVendas->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
        $stmtVendas->execute();

        // Agora, exclua o cliente
        $sqlCliente = "DELETE FROM cliente WHERE idcliente = :idcliente";
        $stmtCliente = $conexao->prepare($sqlCliente);
        $stmtCliente->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);

        if($stmtCliente->execute()) {
            $_SESSION['message'] = "O cliente foi excluído com sucesso!";
            header("Location: tabelacliente.php");
            exit();
        } else {
            $_SESSION['message'] = "A exclusão do cliente falhou.";
            header("Location: tabelacliente.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "ID do cliente não fornecido.";
        header("Location: tabelacliente.php");
        exit();
    }
}



?>
