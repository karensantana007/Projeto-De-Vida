<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $usuario = trim($_POST["usuario"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); // segurança

    // Verifica se já existe o email ou usuário
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? OR usuario = ?");
    $stmt->execute([$email, $usuario]);

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('E-mail ou usuário já cadastrado!'); window.history.back();</script>";
        exit;
    }

    // Insere novo usuário
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, usuario, senha) VALUES (?, ?, ?, ?)");
    
    if ($stmt->execute([$nome, $email, $usuario, $senha])) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar.'); window.history.back();</script>";
    }
}

session_start();

$usuario = $_POST['username'] ?? '';
$senha = $_POST['senha'] ?? '';

// Aqui você validaria com seu banco de dados
// Exemplo fictício:
if ($usuario === 'admin' && $senha === '123') {
    $_SESSION['usuario_nome'] = $usuario;
    header('Location: C:/xampp/htdocs/xampp/loginoficial/login.php');
    exit();
} else {
    echo "Usuário ou senha inválidos!";
}
?>
