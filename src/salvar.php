<?php
//salva os arquivos na pasta saida
function salvarArquivo($nome, $conteudo)
{
    file_put_contents("saida/" . $nome, $conteudo);
}

?>