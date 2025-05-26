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
                    <a href="teste.php">Teste de personalidade</a>
                    <a href="#">Serviços</a>
                    <a href="#">Contato</a>
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

    <!-- FOOTER -->
    <footer>
        <div class="footer-da-landing-page">
            <div class="redes-sociais">Redes Sociais</div>

            <div class="_2025-essence-and-future-todos-os-direitos-reservados">
                © 2025 - Essence and Future. Todos os direitos reservados.
            </div>

            <div class="instagram-essence-and-future">
                Instagram: @Essence_and_Future
            </div>
            
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
                Endereço: Rua Pref. José Deliberador, 300 -<br>Vila Thaide
            </div>
            <div class="line-30"></div>
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
