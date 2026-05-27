<?php

function salvarArquivo($nome, $conteudo)
{
    file_put_contents("saida/" . $nome, $conteudo);
}

?>