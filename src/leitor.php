<?php
//verifica se o arquivo existe
function lerZPL($arquivo){
    if(!file_exists($arquivo)){
        die("Arquivo não encontrado!");
    }

    return file_get_contents($arquivo);
}

?>