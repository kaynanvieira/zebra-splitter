<?php
//divide os blocos de acordo com as coordenadas
function dividirEtiquetas($blocos)
{
    $parte1 = [];
    $parte2 = [];
    $parte3 = [];

    foreach ($blocos as $bloco) {

        $y = null;

        // procura coordenadas válidas
        foreach ($bloco as $linha) {

            if (
                preg_match('/\^FT(\d+),(\d+)/', $linha, $match)
                ||
                preg_match('/\^FO(\d+),(\d+)/', $linha, $match)
            ) {

                $y = (int)$match[2];
                break;
            }
        }

        // ignora blocos sem posição
        if ($y === null) {
            continue;
        }

        // divide
        if ($y <= 450) {

            $parte1[] = $bloco;

        } elseif ($y <= 900) {

            $parte2[] = $bloco;

        } else {

            $parte3[] = $bloco;
        }
    }

    return [
        'parte1' => $parte1,
        'parte2' => $parte2,
        'parte3' => $parte3
    ];
}