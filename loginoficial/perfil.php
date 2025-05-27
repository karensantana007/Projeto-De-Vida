<?php
session_start();
include "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION["usuario_id"];
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if (!$usuario) {
    die("Usuário não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $biografia = $_POST["biografia"];

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $fotoNome = "uploads/user_$id." . $ext;

        if (!is_dir("uploads")) mkdir("uploads", 0777, true);
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
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: #f2f5f9;
      color: #333;
      padding: 0;
      margin: 0;
    }

    .perfil-container {
      background: #fff;
      width: 100%;
      max-width: 420px;
      margin: 60px auto;
      padding: 30px;
      border-radius: 14px;
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
      text-align: center;
    }

    .perfil-container h2 {
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: 600;
      color: #222;
    }

    .foto-wrapper {
      margin-bottom: 25px;
      position: relative;
    }

    .foto-wrapper img {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      background-color: #eee;
      border: 3px solid #ddd;
    }

    .foto-wrapper button {
      margin-top: 8px;
      background: none;
      border: none;
      color: #007bff;
      font-size: 14px;
      cursor: pointer;
    }

    form {
      text-align: left;
    }

    form label {
      display: block;
      font-weight: 500;
      margin-top: 15px;
      font-size: 14px;
    }

    input, textarea {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 6px;
      font-size: 14px;
      background: #f9f9f9;
    }

    input[disabled], textarea[disabled] {
      background: #f2f2f2;
      color: #777;
    }

    .botoes {
      margin-top: 25px;
      display: flex;
      justify-content: space-between;
    }

    .botoes button {
      padding: 8px 16px;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
    }

    #editarBtn {
      background-color: #007bff;
      color: white;
    }

    #salvarBtn {
      background-color: #28a745;
      color: white;
      display: none;
    }

    input[type="file"] {
      display: none;
    }

    @media (max-width: 480px) {
      .perfil-container {
        padding: 20px;
      }

      .botoes {
        flex-direction: column;
        gap: 10px;
      }
    }

    footer {
  background: linear-gradient(to right, #0e3c61, #125993);
  color: #f0f0f0;
  padding: 40px 20px 20px;
  font-family: 'Segoe UI', sans-serif;
  font-size: 14px;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 50px;
  max-width: 1200px;
  margin: 0 auto;
  padding-bottom: 20px;
}

.footer-section {
  flex: 1 1 250px;
  min-width: 250px;
}

.footer-section h4 {
  font-size: 16px;
  margin-bottom: 12px;
  color: #ffffff;
  line-height: 1.2;
}

.footer-section ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-section li {
  margin-bottom: 6px;
  line-height: 1.3;
  color: #dcdcdc;
  transition: color 0.3s ease;
}

.footer-section li i {
  margin-right: 8px;
  color: #ffffff;
}

.footer-section li:hover {
  color: #ffffff;
  cursor: pointer;
}

.footer-bottom {
  border-top: none;
  padding-top: 15px;
  text-align: center;
  color: rgba(255, 255, 255, 0.6);
  font-size: 13px;
}

@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    align-items: center;
    gap: 30px;
  }

  .footer-section {
    text-align: center;
  }

  .footer-section li i {
    display: inline-block;
  }
}


  </style>
</head>
<body>

<!-- HEADER -->
<header>
  <div class="header-content">
    <div class="menu-wrapper">
      <div class="menu-hamburguer">
        <span></span>
        <span></span>
        <span></span>
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
    <div class="logo">
      <img src="essence (1).png" alt="Logo" />
    </div>
  </div>
</header>

<!-- CONTEÚDO DO PERFIL -->
<div class="perfil-container">
  <h2>Meu Perfil</h2>

  <form method="POST" enctype="multipart/form-data" id="perfilForm">
    <div class="foto-wrapper">
      <img id="preview" src="<?= !empty($usuario['foto']) ? $usuario['foto'] : 'https://via.placeholder.com/150' ?>" alt="Foto de Perfil">
      <input type="file" name="foto" id="foto" accept="image/*" onchange="mostrarPreview(event)">
      <button type="button" onclick="document.getElementById('foto').click()">Trocar Foto</button>
    </div>

    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>" disabled required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" disabled required>

    <label for="biografia">Biografia:</label>
    <textarea name="biografia" id="biografia" rows="3" disabled><?= htmlspecialchars($usuario['biografia'] ?? '') ?></textarea>

    <div class="botoes">
      <button type="button" id="editarBtn">Editar</button>
      <button type="submit" id="salvarBtn">Salvar</button>
    </div>
  </form>
</div>


<footer>
  <div class="footer-container">
    <div class="footer-section">
      <h4>Redes Sociais</h4>
      <ul>
        <li><i class="fab fa-instagram"></i> @Essence_and_Future</li>
        <li><i class="fab fa-facebook"></i> Essence and Future</li>
        <li><i class="fas fa-phone"></i> (18) 99777-0741</li>
      </ul>
    </div>

    <div class="footer-section">
      <h4>Legalidade</h4>
      <ul>
        <li>Termos de Uso</li>
        <li>Política de Privacidade</li>
        <li>Política de Cookies</li>
      </ul>
    </div>

    <div class="footer-section">
      <h4>Contato</h4>
      <ul>
        <li><i class="fas fa-envelope"></i> Essence.Future@gmail.com</li>
        <li><i class="fas fa-map-marker-alt"></i> Rua Pref. José Deliberador, 300 - Vila Thaide</li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    © 2025 - Essence and Future. Todos os direitos reservados.
  </div>
</footer>


<script>
  document.getElementById("editarBtn").addEventListener("click", () => {
    document.getElementById("nome").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("biografia").disabled = false;
    document.getElementById("salvarBtn").style.display = "inline-block";
    document.getElementById("editarBtn").style.display = "none";
  });

  function mostrarPreview(event) {
    const reader = new FileReader();
    reader.onload = function () {
      document.getElementById("preview").src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

</body>
</html>
