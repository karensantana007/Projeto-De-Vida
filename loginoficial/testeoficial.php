<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de personalidade</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>

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

    <!-- LOGO CENTRALIZADA -->
    <div class="logo">
      <img src="essence (1).png" alt="Logo" />
    </div>

  </div>
</header>

<div class="container">
  <h2>Teste de Personalidade – Você tem perfil para Direito?</h2>
  <br><br>
  <form action="processa_teste.php" method="post" id="formulario-teste">

    <?php
    $perguntas = [
    // Etapa 1
    "Você prefere discutir temas sociais ou resolver problemas matemáticos?",
    "Sente mais interesse por livros de história ou de física?",
    "Costuma analisar o comportamento humano ou estruturas técnicas?",
    "Prefere interpretar textos ou elaborar fórmulas?",
    "Assuntos como política e direitos humanos despertam seu interesse?",

    // Etapa 2
    "Você tem facilidade em falar em público?",
    "Gosta de argumentar com lógica e clareza em discussões?",
    "Prefere escrever um texto argumentativo ou construir um projeto técnico?",
    "Consegue se colocar no lugar do outro facilmente?",
    "Tem interesse por ética, leis e justiça social?",

    // Etapa 3
    "Acha mais atraente ajudar em causas sociais do que desenvolver novas tecnologias?", 
    "Valoriza mais a comunicação humana ou o raciocínio lógico?",
    "Se vê solucionando conflitos interpessoais ou otimizando processos técnicos?",
    "Prefere entender as motivações das pessoas ou como as máquinas funcionam?",
    "Gosta de atuar em contextos com impacto social direto?"
];

$respostas = [
    ["Discutir temas sociais", "Resolver problemas matemáticos"],
    ["Livros de história", "Livros de física"],
    ["Analisar o comportamento humano", "Analisar estruturas técnicas"],
    ["Interpretar textos", "Elaborar fórmulas"],
    ["Sim, tenho muito interesse", "Não, prefiro temas científicos"],

    ["Sim, me expresso bem em público", "Não, prefiro atividades mais reservadas"],
    ["Sim, gosto de discutir com argumentos", "Não, prefiro decisões práticas e rápidas"],
    ["Texto argumentativo", "Projeto técnico"],
    ["Sim, tenho empatia facilmente", "Tenho mais foco em lógica e resultado"],
    ["Sim, me interesso bastante", "Não é minha prioridade"],

    ["Ajudar causas sociais", "Criar soluções tecnológicas"],
    ["Comunicação humana", "Raciocínio lógico"],
    ["Solucionar conflitos interpessoais", "Otimizar processos técnicos"],
    ["Entender motivações humanas", "Entender funcionamento de máquinas"],
    ["Sim, é algo que valorizo muito", "Não é meu foco principal"]
];

for ($i = 0; $i < 3; $i++) {
    echo "<div class='step".($i === 0 ? " active" : "")."'>";
    for ($j = 0; $j < 5; $j++) {
        $index = $i * 5 + $j;
        $num = $index + 1;
        echo "<p><strong>$num. {$perguntas[$index]}</strong></p>";
        echo "<label><input type='radio' name='p$num' value='A' required> {$respostas[$index][0]}</label>";
        echo "<label><input type='radio' name='p$num' value='B'> {$respostas[$index][1]}</label>";
    }
    echo "</div>";
}
    ?>

<br>

    <div class="navigation">
      <button type="button" class="btn" onclick="voltar()">Voltar</button>
      <button type="button" class="btn" onclick="avancar()">Avançar</button>
      <input type="submit" value="Ver Resultado" class="btn" id="btnResultado" style="display:none;">
    </div>
  </form>
</div>


<script>
  let etapa = 0;
  const steps = document.querySelectorAll(".step");
  const btnResultado = document.getElementById("btnResultado");

  function mostrarEtapa(n) {
    steps.forEach((step, i) => {
      step.classList.toggle("active", i === n);
    });

    if (n === steps.length - 1) {
      btnResultado.style.display = "inline-block";
    } else {
      btnResultado.style.display = "none";
    }
  }

  function avancar() {
    if (etapa < steps.length - 1) {
      etapa++;
      mostrarEtapa(etapa);
    }
  }

  function voltar() {
    if (etapa > 0) {
      etapa--;
      mostrarEtapa(etapa);
    }
  }
</script>



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


</body>
</html>