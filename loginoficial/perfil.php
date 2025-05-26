<?php
session_start();
include "conexao.php";

// Redireciona se o usuário não estiver logado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION["usuario_id"];

// Busca os dados do usuário
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

// Atualiza o perfil
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $biografia = $_POST["biografia"];

    // Upload de foto
    if ($_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $fotoNome = "uploads/user_$id." . $ext;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $fotoNome);

        $sql = "UPDATE usuarios SET nome=?, email=?, biografia=?, foto=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nome, $email, $biografia, $fotoNome, $id);
    } else {
        $sql = "UPDATE usuarios SET nome=?, email=?, biografia=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $email, $biografia, $id);
    }

    $stmt->execute();
    header("Location: perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meu Perfil</title>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="estilo.css">
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 20px; }
    .container { max-width: 700px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
    img { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; }
    input, textarea { width: 100%; margin: 10px 0; padding: 10px; border-radius: 6px; border: 1px solid #ccc; }
    button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer; }
    button:hover { background: #0056b3; }
  </style>
</head>
<body>

<!-- Cabeçalho -->
<header>
  <div class="header-content">
    <div class="menu-wrapper">
      <div class="menu-hamburguer"><span></span><span></span><span></span></div>
      <div class="menu-container">
        <a href="landingpage.php">Home</a>
        <a href="teste.php">Testes de personalidade</a>
        <a href="sobremim.php">Sobre mim</a>
        <a href="direito.php">Sobre o Direito</a>
        <a href="juiz.php">O que é ser um Juiz?</a>
        <a href="perfil.php">Meu perfil</a>
        <a href="sair.php">Sair da minha conta</a>
      </div>
    </div>
    <div class="logo">
      <img src="essence (1).png" alt="Logo" />
    </div>
  </div>
</header>

<!-- Formulário de perfil -->
<div class="container">
  <h2>Olá, <?= htmlspecialchars($usuario["nome"]) ?>!</h2>

  <form method="post" enctype="multipart/form-data">
    <label>Foto de Perfil:</label><br>
    <img id="preview" src="<?= $usuario['foto'] ?: 'https://via.placeholder.com/150' ?>" alt="Foto de Perfil"><br>
    <input type="file" name="foto" onchange="mostrarPreview(event)"><br>

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

    <label>Biografia:</label>
    <textarea name="biografia" rows="4"><?= htmlspecialchars($usuario['biografia']) ?></textarea>

    <button type="submit">Salvar Alterações</button>
  </form>

  <form action="logout.php" method="post">
    <button type="submit" style="background:red;">Sair</button>
  </form>
</div>

<!-- Rodapé -->
<footer>
  <div class="footer-da-landing-page">
    <div class="redes-sociais">Redes Sociais</div>
    <div class="_2025-essence-and-future-todos-os-direitos-reservados">
      © 2025 - Essence and Future. Todos os direitos reservados.
    </div>
    <div class="instagram-essence-and-future">Instagram: @Essence_and_Future</div>
    <div class="facebook-essence-and-future">Facebook: Essence and Future</div>
    <div class="telefone-18-997770741">Telefone: (18) 997770741</div>
    <div class="line-28"></div>
    <div class="avisos-legais">Avisos Legais</div>
    <div class="termos-de-uso">Termos de Uso</div>
    <div class="pol-tica-de-privacidade">Política de Privacidade</div>
    <div class="pol-tica-de-cookies">Política de Cookies</div>
    <div class="line-29"></div>
    <div class="contato">Contato</div>
    <div class="e-mail-essence-future-gmail-com">
      E-mail: Essence.Future@gmail.com
    </div>
    <div class="endere-o-rua-pref-jos-deliberador-300-vila-thaide">
      Endereço: Rua Pref. José Deliberador, 300 -<br />Vila Thaide
    </div>
    <div class="line-30"></div>
  </div>
</footer>

<!-- Preview da imagem -->
<script>
function mostrarPreview(event) {
  const reader = new FileReader();
  reader.onload = function() {
    document.getElementById('preview').src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>