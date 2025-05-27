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

      <a href="javascript:history.back()" class="botao-voltar">
  <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
    <path d="M15 6l-6 6 6 6" stroke="white" stroke-width="2" fill="none" />
  </svg>
  Voltar
</a>

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
  const form = document.getElementById("formulario-teste");

  function mostrarEtapa(n) {
    steps.forEach((step, i) => {
      step.classList.toggle("active", i === n);
    });

    btnResultado.style.display = (n === steps.length - 1) ? "inline-block" : "none";
  }

  function avancar() {
    // Verifica se todas as perguntas da etapa atual estão respondidas
    const currentStep = steps[etapa];
    const radios = currentStep.querySelectorAll('input[type="radio"]');
    const names = new Set();

    let allAnswered = true;
    radios.forEach((radio) => names.add(radio.name));

    names.forEach((name) => {
      const checked = currentStep.querySelector(`input[name="${name}"]:checked`);
      if (!checked) {
        allAnswered = false;
      }
    });

    if (!allAnswered) {
      alert("Por favor, responda todas as perguntas antes de avançar.");
      return;
    }

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

  // Mostrar primeira etapa ao carregar
  mostrarEtapa(etapa);
</script>




 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
<br>
  <div class="footer-bottom">
    <p>© 2025 Essence and Future — Todos os direitos reservados.</p>
  </div>
</footer>



</body>
</html>