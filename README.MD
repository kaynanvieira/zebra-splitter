# Zebra Splitter V1

Projeto em PHP para interceptar arquivos ZPL (.prn) gerados por ERP/WMS e dividir etiquetas grandes em múltiplas etiquetas menores para impressoras Zebra menores.

## Objetivo

Permitir impressão emergencial em impressoras Zebra GC420t de etiquetas originalmente feitas para Zebra ZT230.

## Funcionalidades

- Leitura de arquivos `.prn`
- Parser de comandos ZPL
- Separação automática por regiões da etiqueta
- Recalculo de coordenadas
- Geração de múltiplos arquivos `.prn`
- Impressão via LPT1

## Estrutura

- `entrada/` → arquivos originais
- `saida/` → arquivos gerados
- `src/` → módulos do sistema

## Tecnologias

- PHP
- ZPL
- Zebra GC420t
- Zebra ZT230

## Status

Versão inicial funcional.