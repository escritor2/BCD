<?php
$servername = "localhost";
$username = "root";
$password = "senaisp";
$dbname = "MECANICA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cod_cliente = $_GET['cod_cliente'];
$sql = "SELECT * FROM Clientes WHERE Cod_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cod_cliente);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Cliente não encontrado.");
}

$stmt->close();
$conn->close();
?>

<form action="atualizar.php" method="post">
    <input type="hidden" name="Cod_cliente" value="<?php echo htmlspecialchars($row['Cod_cliente']); ?>">
    <label>CPF:</label>
    <input type="text" name="cpf" value="<?php echo htmlspecialchars($row['CPF']); ?>" required><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required><br>
    <label>CEP:</label>
    <input type="text" name="cep" value="<?php echo htmlspecialchars($row['CEP']); ?>" required><br>
    <label>Data de Nascimento:</label>
    <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($row['Data_nascimento']); ?>" required><br>
    <button type="submit">Atualizar</button>
</form>
