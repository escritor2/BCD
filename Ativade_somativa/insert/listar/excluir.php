<?php
$servername = "localhost";
$username = "root";
$password = "senaisp"; 
$dbname = "MECANICA";


if (!isset($_GET['cod_cliente'])) {
    die("Erro: Código do cliente (cod_cliente) não fornecido para exclusão.");
}
$cod_cliente = $_GET['cod_cliente']; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("A conexão falhou: " . $conn->connect_error);
}

$sql = "DELETE FROM Clientes WHERE Cod_cliente = ?"; 

$stmt = $conn->prepare($sql);

if ($stmt === FALSE) {
    die("Erro na preparação da consulta: " . $conn->error);
}

$stmt->bind_param("i", $cod_cliente); 

if ($stmt->execute()) {
    echo "Cliente (Código: {$cod_cliente}) excluído com sucesso!";
} else {
    echo "Error ao excluir: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>