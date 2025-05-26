<?php
$servername = "localhost";
$username = "root"; // ou outro usuário do MySQL
$password = "";     // senha do MySQL
$database = "usuarios";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>