# Guiao WP3 - JavaScript

## Objetivo

Adicionar JavaScript ao projeto de venda de bilhetes para validar formularios no browser, alterar elementos da pagina por DOM e melhorar a interacao do utilizador.

## Funcionalidades realizadas exclusivamente no browser

| Pagina | Formulario/Interacao | Campos obrigatorios | Validacao JavaScript |
| --- | --- | --- | --- |
| criar_conta.html | Criar conta de adepto | nome, e-mail, password | nome nao vazio, e-mail valido, password com pelo menos 4 caracteres |
| bilhete.html | Escolher bilhete | zona, quantidade | obrigatorio escolher zona; quantidade entre 1 e 4 |
| pagamento.html | Simular pagamento | numero do cartao | cartao com 16 digitos |
| admin.html | Criar novo jogo | adversario, data, hora, lotacao, preco | campos obrigatorios, lotacao e preco superiores a zero |
| index.html | Mostrar/ocultar informacao | nenhum | botao altera a visibilidade da descricao do projeto |

## Ficheiro JavaScript criado

| Ficheiro | Descricao |
| --- | --- |
| scripts/app.js | Contem as funcoes de validacao dos formularios, mensagens de erro, alteracao visual de campos invalidos, calculo do total do bilhete, simulacao de pagamento e mostrar/ocultar informacao do projeto |

## Manipulacao do DOM

Foi implementado um botao na pagina inicial para mostrar e ocultar informacao sobre o projeto e os elementos/atores:

- Francisco: diretor;
- Tomas: adepto;
- Leonor: gestora da manutencao.

Tambem foi implementada alteracao dinamica do resumo do bilhete, calculando o total conforme a zona e quantidade escolhidas.

## Estado das user stories

| Ator | User Story | Descricao | Prioridade | Implementado |
| --- | --- | --- | --- | --- |
| Tomas | USR1 | Como adepto quero criar conta na aplicacao | Alta | 100% |
| Tomas | USR2 | Como adepto quero listar os jogos disponiveis | Alta | 100% |
| Tomas | USR3 | Como adepto quero escolher um bilhete com precos diferentes | Alta | 100% |
| Tomas | USR4 | Como adepto quero simular pagamento | Alta | 100% |
| Francisco | USR5 | Como diretor quero criar um novo jogo no backoffice | Media | 70% |
| Leonor | USR6 | Como gestora de manutencao quero verificar formularios e dados da plataforma | Media | 60% |

## Ficheiros alterados/criados

- index.html
- criar_conta.html
- bilhete.html
- pagamento.html
- admin.html
- styles/style.css
- scripts/app.js
- GUIAO-WP3-PASSO-A-PASSO.md

## Como testar

1. Abrir o projeto no MAMP.
2. Entrar em `index.html`.
3. Carregar em `Mostrar informacao do projeto`.
4. Ir para `Criar Conta` e tentar submeter campos vazios ou e-mail invalido.
5. Ir para `Comprar Bilhete`, escolher zona e quantidade, e confirmar o calculo do total.
6. No pagamento, testar um cartao com menos de 16 digitos e depois um com 16 digitos.
7. Abrir `admin.html` e testar os campos obrigatorios do formulario.

## Submissao Moodle

Submeter os ficheiros HTML, CSS, PHP e JS em que houve trabalho, juntamente com o ficheiro `omeujavascript.log` com o git log do repositorio local.
