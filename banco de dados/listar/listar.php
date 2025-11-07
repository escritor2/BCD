<?php
$servername = "localhost";
$username = "root";
$password = "senaisp";
$dbname = "livraria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM usuario");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: auto;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff; 
            color: white;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; 
        }
        tr:hover {
            background-color: #f1f1f1; 
        }
        .btn, .btn-action {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .btn-action {
            margin: 0 4px;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #28a745; 
            color: white;
        }
        .btn-edit {
            background-color: #ffc107;
            color: black;
        }
        .btn-delete {
            background-color: #dc3545; 
            color: white;
        }
        .btn-home {
            background-color: #6c757d; 
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Usuários</h2>
        <a href="index.html" class="btn btn-home">Página Inicial</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['id_usuario']}</td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>";
                        echo "<a href='editar.php?id_usuario={$row['id_usuario']}' class='btn-action btn-edit'>Editar</a>";
                        echo "<a href='excluir.php?id_usuario={$row['id_usuario']}' class='btn-action btn-delete'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum usuário encontrado.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
