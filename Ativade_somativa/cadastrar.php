<?php
header('Content-Type: application/json');


$response = array(
    'status' => 'error',
    'message' => 'Ocorreu um erro desconhecido.'
);

$conn = new mysqli("localhost", "root", "senaisp", "mecanica");

if ($conn->connect_error) {
    $response['message'] = "Conexão falhou: " . $conn->connect_error;
    echo json_encode($response);
    exit;
}

if (!isset($_POST['nome_cliente'], $_POST['CPF'], $_POST['telefone'], $_POST['marca_veiculo'], $_POST['servico'], $_POST['nome_produto'])) {
    $response['message'] = "Todos os campos obrigatórios devem ser preenchidos.";
    echo json_encode($response);
    exit;
}

$nome = $conn->real_escape_string($_POST['nome_cliente']);
$CPF = $conn->real_escape_string($_POST['CPF']);
$telefone = $conn->real_escape_string($_POST['telefone']);
$marca_veiculo = $conn->real_escape_string($_POST['marca_veiculo']);
$servico = $conn->real_escape_string($_POST['servico']);
$nome_produto = $conn->real_escape_string($_POST['nome_produto']);
$observacao = $conn->real_escape_string($_POST['observacao']); 
$sql = "INSERT INTO Funcionario_Cadastrar (nome_cliente, CPF, telefone, marca_veiculo, servico, nome_produto, observacao) 
        VALUES ('$nome', '$CPF', '$telefone', '$marca_veiculo', '$servico', '$nome_produto', '$observacao')";

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
    $response['message'] = 'Cliente cadastrado com sucesso!';
} else {
    $response['message'] = "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
echo json_encode($response);
exit;
?>