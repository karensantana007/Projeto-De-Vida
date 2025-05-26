<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $novaSenha = password_hash("nova123", PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $novaSenha, $email);
    if ($stmt->execute()) {
        $mensagem = "Senha redefinida para: nova123";
    } else {
        $erro = "Erro ao redefinir a senha.";
    }
}
?>

<link rel="stylesheet" href="estilo.css">

<form method="post">
  <h2>Recuperar Senha</h2>
  <?php
    if (isset($mensagem)) echo "<p style='color:green;'>$mensagem</p>";
    if (isset($erro)) echo "<p style='color:red;'>$erro</p>";
  ?>
  <input type="email" name="email" placeholder="Seu email" required>
  <button type="submit">Redefinir</button>
</form>