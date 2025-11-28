<?php
$Cod_cliente = $_POST['Cod_cliente'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$cep = $_POST['cep'];
$data_nascimento = $_POST['data_nascimento'];

$conn = new mysqli("localhost", "root", "senaisp", "MECANICA");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Clientes (Cod_cliente, CPF, Email, CEP, Data_nascimento) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $Cod_cliente, $cpf, $email, $cep, $data_nascimento);

if ($stmt->execute()) {
    echo "Dados salvos com sucesso";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
