<?php

require_once "src/leitor.php";
require_once "src/parser.php";
require_once "src/divisor.php";
require_once "src/gerador.php";
require_once "src/salvar.php";

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantidadePaletes = isset($_POST['quantidade']) ? (int)$_POST['quantidade'] : 1;
    
    if ($quantidadePaletes < 1) {
        $quantidadePaletes = 1;
    }

    $arquivo = "entrada/r_armaz.prn";
    $zpl = lerZPL($arquivo);
    $linhas = normalizarZPL($zpl);
    $blocos = agruparBlocos($linhas);
    $partes = dividirEtiquetas($blocos);

    $zpl1_base = gerarZPL($partes['parte1'], 450, 0, 0, 'parte1');
    $zpl2_base = gerarZPL($partes['parte2'], 500, 400, 30, 'parte2');
    $zpl3_base = gerarZPL($partes['parte3'], 450, 900, 0, 'parte3');

    $conteudo_final = "";

    for ($i = 1; $i <= $quantidadePaletes; $i++) {
        $conteudo_final .= $zpl1_base . "\n";
        $conteudo_final .= $zpl2_base . "\n";
        $conteudo_final .= $zpl3_base . "\n";
    }

    salvarArquivo("imprimir_tudo.prn", $conteudo_final);

    $mensagem = "<div class='sucesso'>✓ Sequência para <strong>{$quantidadePaletes}</strong> palete(s) gerada! Agora execute o arquivo .bat.</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Zebra Splitter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="logo-container">
        <img src="assets/logo.png" alt="Logo CCN Distribuidora" class="logo">
    </div>
    
    <?php if (!empty($mensagem)) echo $mensagem; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="quantidade">Quantidade de Paletes:</label>
            <input type="number" id="quantidade" name="quantidade" min="1" value="1" required autofocus>
        </div>
        <button type="submit">Gerar Lote de Etiquetas</button>
    </form>
</div>

</body>
</html>