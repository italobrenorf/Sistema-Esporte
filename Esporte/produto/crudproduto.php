<?php 

require_once('../conexao.php');

if (isset($_POST['cadastrar'])) {
    $nomeprod = $_POST['nomeprod'];
    $tamanho = $_POST['tamanho'];
    $tipo = $_POST['tipo'];
    $genero = $_POST['genero'];
    $valor = $_POST['valor'];
    $marca = $_POST['marca'];
    $urlprod = $_POST['urlprod'];

    $sql = "INSERT INTO produto (nomeprod, tamanho, tipo, genero, valor, marca, urlprod) VALUES (:nomeprod, :tamanho, :tipo, :genero, :valor, :marca, :urlprod)";

    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':nomeprod', $nomeprod, PDO::PARAM_STR);
    $stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_STR);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
    $stmt->bindParam(':valor', $valor, PDO::PARAM_INT);
    $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
    $stmt->bindParam(':urlprod', $urlprod, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $_SESSION['message'] = "O produto $nomeprod foi registrado.";
        header("Location: tabelaproduto.php");
        exit();
    } else {
        $_SESSION['message'] = "Não foi possível registrar o produto.";
        header("Location: tabelaproduto.php");
        exit();
    }
}

if (isset($_POST['update'])) {
    $nomeprod = $_POST['nomeprod'];
    $tamanho = $_POST['tamanho'];
    $tipo = $_POST['tipo'];
    $genero = $_POST['genero'];
    $valor = $_POST['valor'];
    $marca = $_POST['marca'];
    $idprod = $_POST['idprod'];
    $urlprod = $_POST['urlprod'];

    $sql = "UPDATE produto SET nomeprod = :nomeprod, tamanho = :tamanho, tipo = :tipo, genero = :genero, valor = :valor, marca = :marca, urlprod = :urlprod WHERE idprod = :idprod";

    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':nomeprod', $nomeprod, PDO::PARAM_STR);
    $stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_STR);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
    $stmt->bindParam(':valor', $valor, PDO::PARAM_INT);
    $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
    $stmt->bindParam(':urlprod', $urlprod, PDO::PARAM_STR);
    $stmt->bindParam(':idprod', $idprod, PDO::PARAM_INT);

    if ($stmt->execute()) {
    $_SESSION['message'] = " O produto $nomeprod foi alterado com sucesso!";
        header("Location: tabelaproduto.php");
        exit();
    } else {
        $_SESSION['message'] = "Não foi possível alterar o produto.";
        header("Location: tabelaproduto.php");
        exit();
    }
}

if (isset($_GET['excluir'])) {
    $idprod = $_GET['idprod'];

    $sql = "DELETE FROM produto WHERE idprod = :idprod";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':idprod', $idprod, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['message'] = "O produto foi excluído!";
        header("Location: tabelaproduto.php");
        exit();
    } else {
        $_SESSION['message'] = "Não foi possível excluir o produto.";
        header("Location: tabelaproduto.php");
        exit();
    }
}

?>
