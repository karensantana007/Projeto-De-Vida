<?php
// Carrega informações se já salvas
$dados = [];
if (file_exists('dados_perfil.json')) {
  $dados = json_decode(file_get_contents('dados_perfil.json'), true);
}
$nome = $dados['nome'] ?? 'João da Silva';
$email = $dados['email'] ?? 'joao@email.com';
$cidade = $dados['cidade'] ?? 'Presidente Prudente';
$profissao = $dados['profissao'] ?? 'Estudante de Direito';
$bio = $dados['bio'] ?? 'Apaixonado por justiça social e igualdade.';
$foto = $dados['foto'] ?? 'uploads/perfil_padrao.png'; // imagem padrão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Meu Perfil</title>
  <link rel="stylesheet" href="style2.css">
  <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #eef1f5;
    margin: 0;
    padding: 0;
  }

  .form-perfil {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .form-perfil h1 {
    color: #19498d;
    margin-bottom: 25px;
    font-size: 24px;
    text-align: center;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
    color: #333;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.3s;
  }

  .form-group input:focus,
  .form-group textarea:focus {
    border-color: #19498d;
    outline: none;
  }

  .form-group textarea {
    resize: vertical;
  }

  .foto-perfil {
    width: 140px;
    height: 140px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #19498d;
    display: block;
    margin: 0 auto 15px auto;
  }
  
.label-foto {
  display: block; /* muda de inline-block para block */
  width: 200px;
  margin: 0 auto 10px auto; /* centraliza horizontalmente */
  padding: 5px 10px;
  border-radius: 4px;
  cursor: pointer;
  text-align: center;
  font-size: 12px;
  transition: background-color 0.3s;
  color: white;
}

  .label-foto:hover {
    background-color:rgba(101, 140, 193, 0.81);
  }

  input[type="file"] {
    display: none;
  }

  .form-actions {
    text-align: center;
    margin-top: 30px;
  }

  .form-actions button {
    background-color: #19498d;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .form-actions button:hover {
    background-color: #153c70;
  }

  .mensagem-sucesso {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
    text-align: center;
    font-size: 14px;
  }
</style>

</head>
<body>

<header>
  <div class="header-content">
    <div class="menu-wrapper">
      <div class="menu-hamburguer">
        <span></span><span></span><span></span>
      </div>
      <div class="menu-container">
        <a href="landingpage.php">Home</a>
        <a href="teste.php">Testes de personalidade</a>
        <a href="sobremim.php">Sobre mim</a>
        <a href="direito.php">Sobre o Direito</a>
        <a href="juiz.php">O que é ser um Juíz?</a>
        <a href="perfil.php">Meu perfil</a>
        <a href="sair.php">Sair da minha conta</a>
      </div>
    </div>
    <a href="javascript:history.back()" class="botao-voltar">
      <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
        <path d="M15 6l-6 6 6 6" stroke="white" stroke-width="2" fill="none" />
      </svg>
      Voltar
    </a>
  </div>
</header>

<main>
  <form class="form-perfil" action="salvar_perfil.php" method="POST" enctype="multipart/form-data">
    <h1>Meu Perfil</h1>

    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] === '1'): ?>
      <div class="mensagem-sucesso">Perfil salvo com sucesso!</div>
    <?php endif; ?>

    <img id="preview" src="<?= htmlspecialchars($foto) ?>" class="foto-perfil" alt="Foto de perfil">

    <div class="form-group">
      <label class="label-foto" for="foto">Trocar Foto de Perfil</label>
      <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImagem(event)">
    </div>

    <div class="form-group">
      <label>Nome</label>
      <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>" required>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
    </div>

    <div class="form-group">
      <label>Profissão</label>
      <input type="text" name="profissao" value="<?= htmlspecialchars($profissao) ?>">
    </div>

    <div class="form-group">
      <label>Cidade</label>
      <input type="text" name="cidade" value="<?= htmlspecialchars($cidade) ?>">
    </div>

    <div class="form-group">
      <label>Biografia</label>
      <textarea name="bio" rows="5"><?= htmlspecialchars($bio) ?></textarea>
    </div>

    <div class="form-actions">
      <button type="submit">Salvar Perfil</button>
    </div>
  </form>
</main>

<footer class="footer-da-landing-page">
  <div class="footer-container">
    <div class="footer-section">
      <h3>Redes Sociais</h3>
      <div class="line"></div>
      <p><i class="fab fa-instagram"></i> @essence_and_future</p>
      <p><i class="fab fa-facebook"></i> /essenceandfuture</p>
      <p><i class="fas fa-phone"></i> (18) 99777-0741</p>
    </div>
    <div class="footer-section">
      <h3>Avisos Legais</h3>
      <div class="line"></div>
      <p><i class="fas fa-gavel"></i> <a href="#">Termos de Uso</a></p>
      <p><i class="fas fa-user-shield"></i> <a href="#">Política de Privacidade</a></p>
      <p><i class="fas fa-cookie-bite"></i> <a href="#">Política de Cookies</a></p>
    </div>
    <div class="footer-section">
      <h3>Contato</h3>
      <div class="line"></div>
      <p><i class="fas fa-envelope"></i> essence.future@gmail.com</p>
      <p><i class="fas fa-map-marker-alt"></i> Rua Pref. José Deliberador, 300 - Vila Thaíde</p>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 Essence and Future — Todos os direitos reservados.</p>
  </div>
</footer>

<script>
  function previewImagem(event) {
    const reader = new FileReader();
    reader.onload = function() {
      document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

</body>
</html>