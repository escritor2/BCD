<?php
$servername = "localhost";
$username = "root";
$password = "senaisp";
$dbname = "livraria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nome = htmlspecialchars($_POST['nome']);
$email = htmlspecialchars($_POST['email']);

$message = "";
$status = ""; 

$sql = "INSERT INTO usuario (nome, email) VALUES ('$nome', '$email')";

if ($conn->query($sql) === TRUE) {
    $message = "Dados do usuário **$nome** salvos com sucesso!";
    $status = "success";
} else {
    $message = "Erro ao salvar registro: " . $conn->error;
    $status = "error";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            width: 400px;
        }
        .message-box {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .message-box.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message-box.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            margin-left: 10px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="message-box <?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
        
        <a href="listar.php" class="btn">Ver Lista de Usuários</a>

        <a href="index.html" class="btn btn-secondary">Cadastrar Novo</a>
    </div>

</body>
</html>
