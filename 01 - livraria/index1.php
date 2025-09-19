<?php
// comunicação com o banco de dados 
$mysqli = mysqli_connect('localhost', 'root', 'senaisp', 'livraria');

// verificar conexão
if (mysqli_connect_errno()) {
    die("Erro ao conectar ao banco: " . mysqli_connect_error());
}

// segurança em buscar valores no banco
$columns = array('titulo','ano_publicacao', 'cod_livro', 'cod_editora', 'genero', 'cod_autor', 'preco', 'quantidade');

// trazer conteúdo do banco 
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// trazer os dados em ordem crescente/decrescente
$sort_order = isset($_GET['orde r']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// consultar tabela correta (livro)
$query = "SELECT * FROM livro ORDER BY $column $sort_order";
if ($result = $mysqli->query($query)) {
    // variáveis para manipular setas
    $up_or_down = $sort_order == 'ASC' ? 'up' : 'down';
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Banco de Dados - Livraria</title>
        <meta charset="utf-8">
        <style>
            table { border-collapse: collapse; width: 60%; }
            th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
            th a { text-decoration: none; }
            .highlight { background: #f0f0f0; }
        </style>
    </head>
    <body>
        <h2>Lista de Livros</h2>
        <table>
            <tr>
                <th><a href="index1.php?column=titulo&order=<?php echo $asc_or_desc; ?>">Título <?php echo $column == 'titulo' ? '-' . $up_or_down : ''; ?></a></th>
                <th><a href="index1.php?column=ano_publicacao&order=<?php echo $asc_or_desc; ?>">Ano Publicação <?php echo $column == 'ano_publicacao' ? '-' . $up_or_down : ''; ?></a></th>
                <th><a href="index1.php?column=cod_livro&order=<?php echo $asc_or_desc; ?>">Código <?php echo $column == 'cod_livro' ? '-' . $up_or_down : ''; ?></a></th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td <?php echo $column == 'titulo' ? $add_class : ''; ?>><?php echo $row['Titulo']; ?></td>
                    <td <?php echo $column == 'ano_publicacao' ? $add_class : ''; ?>><?php echo $row['Ano_publicacao']; ?></td>
                    <td <?php echo $column == 'cod_livro' ? $add_class : ''; ?>><?php echo $row['Cod_livro']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
    </html>
    <?php 
    $result->free();   
}
?>