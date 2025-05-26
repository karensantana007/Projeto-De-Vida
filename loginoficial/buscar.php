<?php
$termo = $_GET['q'] ?? '';
echo "Você buscou por: " . htmlspecialchars($termo);
// Aqui você pode fazer lógica para buscar testes, perfil etc.
?>