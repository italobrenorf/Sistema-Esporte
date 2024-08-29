<?php 

 define('HOST', 'localhost');
 define('USUARIO', 'root');
 define('BDNAME', 'esporte');
 define('SENHA','');

 try {
 $conexao = new PDO('mysql:host=' . HOST . ';dbname=' . BDNAME, USUARIO, SENHA );
} 

catch(PDOException $e) {
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso. Erro gerado" . $e->getMessage();
 }

?>
