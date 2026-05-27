<?php

require_once "src/leitor.php";
require_once "src/parser.php";
require_once "src/divisor.php";
require_once "src/gerador.php";
require_once "src/salvar.php";

$arquivo = "entrada/r_armaz.prn";

$zpl = lerZPL($arquivo);

$linhas = normalizarZPL($zpl);

$blocos = agruparBlocos($linhas);

$partes = dividirEtiquetas($blocos);


// gera os novos zpl

$zpl1 = gerarZPL(
    $partes['parte1'],
    450,
    0,
    0,
    'parte1'
);

$zpl2 = gerarZPL(
    $partes['parte2'],
    500,
    400,
    30,
    'parte2'
);

$zpl3 = gerarZPL(
    $partes['parte3'],
    450,
    900,
    0,
    'parte3'
);


// salva

salvarArquivo("parte1.prn", $zpl1);

salvarArquivo("parte2.prn", $zpl2);

salvarArquivo("parte3.prn", $zpl3);


echo "<h1>Arquivos gerados com sucesso!</h1>";
?>