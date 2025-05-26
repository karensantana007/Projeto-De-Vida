<?php
$humanas = 0;

for ($i = 1; $i <= 15; $i++) {
    if (isset($_POST["p$i"]) && $_POST["p$i"] === 'A') {
        $humanas++;
    }
}

$percentual = round(($humanas / 15) * 100);

// Redireciona para a página de resultado com o percentual
header("Location: resultado.php?humanas=$percentual");
exit;