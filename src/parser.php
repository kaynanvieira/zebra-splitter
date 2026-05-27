<?php

function normalizarZPL($zpl)
{
    $zpl = preg_replace('/^[^\^]+/', '', $zpl);

    $zpl = str_replace("^", "\n^", $zpl);

    $linhas = array_filter(array_map('trim', explode("\n", $zpl)));

    return array_values($linhas);
}

function agruparBlocos($linhas)
{
    $blocos = [];

    $blocoAtual = [];

    foreach ($linhas as $linha) {

        // IGNORA comandos globais
        if (
            strpos($linha, '^XA') === 0 ||
            strpos($linha, '^XZ') === 0 ||
            strpos($linha, '^~CT') === 0 ||
            strpos($linha, '^TA') === 0 ||
            strpos($linha, '^JSN') === 0 ||
            strpos($linha, '^LT') === 0 ||
            strpos($linha, '^MN') === 0 ||
            strpos($linha, '^MT') === 0 ||
            strpos($linha, '^PON') === 0 ||
            strpos($linha, '^PMN') === 0 ||
            strpos($linha, '^JMA') === 0 ||
            strpos($linha, '^JUS') === 0 ||
            strpos($linha, '^LRN') === 0 ||
            strpos($linha, '^CI') === 0 ||
            strpos($linha, '^PW') === 0 ||
            strpos($linha, '^LL') === 0 ||
            strpos($linha, '^LS') === 0
        ) {
            continue;
        }

        $blocoAtual[] = $linha;

        // terminou elemento
        if (trim($linha) == '^FS') {

            $blocos[] = $blocoAtual;

            $blocoAtual = [];
        }
    }

    return $blocos;
}