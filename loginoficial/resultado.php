<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Teste</title>
    <link rel="stylesheet" href="style3.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

    <!-- CONTEÚDO PRINCIPAL -->
    <main>
        <br><br><br><br><br><br>
        <h2>Resultado do Teste de Personalidade</h2>

        <?php
        $humanas = isset($_GET['humanas']) ? intval($_GET['humanas']) : 0;
        $outros = 100 - $humanas;

        if ($humanas >= 70) {
            $perfil = "🎓 Perfil Fortemente de Humanas";
        } elseif ($humanas >= 40) {
            $perfil = "🔍 Perfil Misturado";
        } else {
            $perfil = "🔬 Mais Perfil de Exatas/Biológicas";
        }
        ?>

        <div class="grafico-container">
            <canvas id="graficoPizza"></canvas>
            <div class="grafico-center-text"><?= $humanas ?>%</div>
        </div>

        <div class="resultado">
            <p><strong><?= $perfil ?></strong></p>
            <p><?= $humanas ?>% de afinidade com a área de Humanas</p>
        </div>

        <button class="botao-refazer" onclick="window.location.href='teste.php'">Refazer o Teste</button>
    </main>

<br><br><br><br><br><br><br><br><br>

    
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
        const ctx = document.getElementById('graficoPizza').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, '#182091');
        gradient.addColorStop(1, '#05a9b4');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Humanas', 'Outros'],
                datasets: [{
                    data: [<?= $humanas ?>, <?= $outros ?>],
                    backgroundColor: ['#182091', '#05a9b4'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#182091',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.parsed}%`;
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
