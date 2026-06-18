# Zebra Splitter V1 🦓🖨️

O **Zebra Splitter** é uma solução emergencial em PHP desenvolvida para interceptar e tratar arquivos de impressão ZPL (`.prn`). Ele automatiza a divisão de etiquetas logísticas de grande porte (originalmente projetadas para a **Zebra ZT230**) em três partes menores correlacionadas, permitindo a impressão contínua e sequencial na **Zebra GC420t** sem travar a operação de expedição.

---

## 🚀 O Problema e a Solução

* **Cenário:** A impressora industrial principal (Zebra ZT230) parou para manutenção. O ERP/WMS da empresa gera apenas arquivos `.prn` em lote com coordenadas fixas para etiquetas grandes.
* **Impacto:** Interrupção no fluxo de colagem de paletes devido à incompatibilidade de hardware da impressora reserva (GC420t).
* **Solução:** Este script atua como um middleware de tratamento. Ele realiza o parser dos comandos ZPL originários, recalcula dinamicamente as coordenadas verticais (`^FT` e `^FO`), reduz dimensões de QR Codes e gera um arquivo unificado com a paginação ideal para a logística (Palete 1: Parte 1, 2, 3 -> Palete 2: Parte 1, 2, 3...).

---

## 🛠️ Funcionalidades

- **Parser ZPL Nativo:** Quebra a estrutura bruta do arquivo `.prn` isolando blocos de comando por tag de fechamento (`^FS`).
- **Recálculo de Coordenadas:** Aplica offset vertical dinâmico baseado na área de corte da etiqueta menor.
- **Intercalação Logística Inteligente:** Agrupa as etiquetas geradas por palete, evitando que o operador misture as partes na hora da colagem.
- **Disparo Simplicado:** Gera um arquivo de saída pronto para ser enviado diretamente à porta local `LPT1` via prompt de comando.

---

## 📁 Estrutura do Projeto

```text
ZEBRA_SPLITTER/
├── entrada/           # Arquivo .prn bruto gerado pelo ERP/WMS (ex: r_armaz.prn)
├── saida/             # Arquivos de saída processados (.prn ignorados pelo Git)
├── src/               # Módulos core da aplicação
│   ├── divisor.php    # Lógica de separação por coordenadas Y
│   ├── gerador.php    # Recálculo de tags ZPL, offsets e dimensões
│   ├── leitor.php     # Validação de integridade do arquivo de entrada
│   ├── parser.php     # Normalização de strings ZPL
│   └── salvar.php     # Persistência de arquivos em disco
├── IMPRIMIR.bat       # Script em lote para disparo rápido para a porta LPT1
├── index.php          # Interface web unificada e controlador do fluxo
└── .gitignore         # Proteção de diretórios para arquivos temporários de produção
