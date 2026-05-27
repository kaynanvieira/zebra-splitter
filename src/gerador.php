<?php

function gerarZPL($blocos, $altura = 400, $offsetY = 0, $offsetX = 0, $tipo = '')
{
    $zpl = "";

    $zpl .= "^XA\n";
    $zpl .= "^MMT\n";
    $zpl .= "^PW799\n";
    $zpl .= "^LL{$altura}\n";

    // deslocamento geral
    $zpl .= "^LH{$offsetX},0\n";

    $zpl .= "^PR4\n";
    $zpl .= "~SD15\n";

    foreach ($blocos as $bloco) {

        foreach ($bloco as $linha) {

            // ------------------------
            // AJUSTA FT
            // ------------------------

            if (preg_match('/\^FT(\d+),(\d+)/', $linha, $match)) {

                $x = (int)$match[1];
                $y = (int)$match[2];

                $y -= $offsetY;

                // AJUSTES FINOS PARTE 1
                if ($tipo == 'parte1') {

                    // qr superior
                    if ($y == 324) {
                        $y = 250;
                    }

                    // rua logística
                    if ($y == 439) {
                        $y = 360;
                    }
                }

                $linha = preg_replace(
                    '/\^FT(\d+),(\d+)/',
                    "^FT{$x},{$y}",
                    $linha
                );
            }

            // ------------------------
            // AJUSTA FO
            // ------------------------

            if (preg_match('/\^FO(\d+),(\d+)/', $linha, $match)) {

                $x = (int)$match[1];
                $y = (int)$match[2];

                $y -= $offsetY;

                $linha = preg_replace(
                    '/\^FO(\d+),(\d+)/',
                    "^FO{$x},{$y}",
                    $linha
                );
            }

            // reduz QR
            $linha = str_replace("^BQN,2,10", "^BQN,2,8", $linha);

            $zpl .= $linha . "\n";
        }
    }

    $zpl .= "^PQ1,0,1,Y\n";
    $zpl .= "^XZ";

    return $zpl;
}