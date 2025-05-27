<?php
// Diretório de upload de imagens
$diretorioUpload = 'uploads/';
if (!is_dir($diretorioUpload)) {
    mkdir($diretorioUpload, 0755, true);
}

// Dados existentes
$dados = [];
if (file_exists('dados_perfil.json')) {
    $dados = json_decode(file_get_contents('dados_perfil.json'), true);
}

// Atualiza campos do formulário
$dados['nome'] = $_POST['nome'] ?? $dados['nome'] ?? '';
$dados['email'] = $_POST['email'] ?? $dados['email'] ?? '';
$dados['profissao'] = $_POST['profissao'] ?? $dados['profissao'] ?? '';
$dados['cidade'] = $_POST['cidade'] ?? $dados['cidade'] ?? '';
$dados['bio'] = $_POST['bio'] ?? $dados['bio'] ?? '';

// Processamento da imagem, se houver
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $novoNome = uniqid('foto_', true) . '.' . $extensao;
    $caminhoCompleto = $diretorioUpload . $novoNome;

    // Move o arquivo enviado
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
        $dados['foto'] = $caminhoCompleto;
    }
}

// Salva os dados atualizados no arquivo JSON
file_put_contents('dados_perfil.json', json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Redireciona de volta ao perfil com mensagem de sucesso
header('Location: perfil.php?sucesso=1');
exit;
?>