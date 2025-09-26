<?php
// Conexão com o BD
$mysqli = mysqli_connect('localhost', 'root', 'senaisp', 'AV1');
if (!$mysqli) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Colunas permitidas para ordenação
$columns = array('titulo', 'ano_publicacao', 'preco');

// Coluna para ordenação (validação)
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Ordem (ASC ou DESC)
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Query com ordenação
$query = "SELECT * FROM livros ORDER BY $column $sort_order";
$result = $mysqli->query($query);

if (!$result) {
    die("Erro na consulta: " . $mysqli->error);
}

// Variáveis para a estrutura da tabela
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
$add_class = ' class="highlight"';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Banco de Dados - Livraria</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            font-family: Tahoma, Geneva, sans-serif;
            padding: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th {
            background-color: #54585d;
            border: 1px solid #54585d;
            cursor: pointer;
        }
        th:hover {
            background-color: #64686e;
        }
        th a {
            display: block;
            text-decoration: none;
            padding: 12px 15px;
            color: #ffffff;
            font-weight: bold;
            font-size: 14px;
        }
        th a i {
            margin-left: 5px;
            color: rgba(255,255,255,0.6);
        }
        td {
            padding: 12px 15px;
            color: #333;
            border: 1px solid #ddd;
        }
        tr {
            background-color: #f9f9f9;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
        tr.highlight {
            background-color: #e0f7fa;
        }
        .container {
            text-align: center;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Livros Cadastrados</h1>
        <table>
            <tr>
                <th><a href="index_modelo.php?column=titulo&order=<?php echo $asc_or_desc; ?>">Título <i class="fas fa-sort<?php echo $column == 'titulo' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="index_modelo.php?column=ano_publicacao&order=<?php echo $asc_or_desc; ?>">Ano <i class="fas fa-sort<?php echo $column == 'ano_publicacao' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="index_modelo.php?column=preco&order=<?php echo $asc_or_desc; ?>">Preço <i class="fas fa-sort<?php echo $column == 'preco' ? '-' . $up_or_down : ''; ?>"></i></a></th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td<?php echo $column == 'titulo' ? $add_class : ''; ?>><?php echo htmlspecialchars($row['titulo']); ?></td>
                <td<?php echo $column == 'ano_publicacao' ? $add_class : ''; ?>><?php echo htmlspecialchars($row['ano_publicacao']); ?></td>
                <td<?php echo $column == 'preco' ? $add_class : ''; ?>>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
<?php
$result->free();
$mysqli->close();
?>