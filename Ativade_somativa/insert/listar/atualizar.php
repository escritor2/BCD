<?php
$servername = "localhost";
$username = "root";
$password = "senaisp"; 
$dbname = "MECANICA";


$cod_cliente = $_POST['Cod'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$cep = $_POST['cep'];
$data_nascimento = $_POST['data_nascimento'];


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("A conexão falhou: " . $conn->connect_error);
}


$sql = "UPDATE Clientes SET CPF = ?, Email = ?, CEP = ?, Data_nascimento = ? WHERE Cod_cliente = ?"; 


$stmt = $conn->prepare($sql);

if ($stmt === FALSE) {
    die("Erro na preparação da consulta: " . $conn->error);
}


$stmt->bind_param("ssssi", $cpf, $email, $cep, $data_nascimento, $cod_cliente); 

if ($stmt->execute()) {
    echo "Dados do Cliente (Código: {$cod_cliente}) atualizados com sucesso!";
} else {
    echo "Error ao atualizar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>