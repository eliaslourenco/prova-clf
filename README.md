# Prova Técnica Programador Web

A prova foi realizada utilizando PHP 7.4 nativo, sem utilização de framework, criei uma estrutura básica de diretórios tentando sempre respeitar as boas práticas da Orientação a Objetos e dos princípios SOLID.

## Instalação

Como não foi utilizado nenhum framework, e por se tratar de uma lógica relativamente simples, não foi necessário utilização de pacotes externos, sendo assim não será necessário rodar o composer install, apenas executar o projeto.
### Para executar o script
Como a aplicação não possui interface gráfica interativa, basta acessar a pasta raiz dentro de um ambiente PHP, ou até mesmo executar apenas o index.php, ele já irá se encarregar de solicitar as chamadas necessárias e processar os arquivos .dat conforme solicitado. O único retorno gráfico é no final da execução, a aplicação retorna um resumo do que foi escrito no arquivo de saída e sua localização dentro dos diretórios.

# Resumo da implementação.
O fluxo básico é o mesmo proposto, ele irá ler apenas arquivos .dat e processar os dados (desde que estejam respeitando a estrutura adotada). Por último irá gerar o Relatório solicitado. 
### Fluxo Básico
1. Faz um "scan" de todos arquivos dentro da pasta ./data/in
caso seja do tipo .dat ele encaminha processa os dados, caso não seja, a aplicação não processa os dados e registra uma mensagem informando o erro do formato em ./app/logs/error.txt 
2. Processa e armazena os dados contidos dentro dos arquivos .dat (necessário que estejam no formato padrão adotado). Identifica qual o tipo da entidade ao qual a linha do dado pertence, distribui e armazena através da model correspondente. Pelo fato de que foi solicitado que os dados fossem armazenados em arquivos com texto, para manter a lógica e execução simples, não vi a necessidade de utilização de base de dados SQL, apenas armazenei os dados temporariamente dentro de sessões organizadas por Entidade.
3. Após o processamento e armazenamento temporário dos dados extraídos dos arquivos .dat, eu faço a chamada para o objeto responsável pelo Relatório, para que faça as buscas necessárias nos dados para responder as questões propostas pelo desafio.
4. Por último eu faço o output do arquivo *.done.dat* dentro do diretório *./data/output* e registro o sucesso em *./app/logs/success.txt* e retorno na tela apenas o resultado que foi inserido e o nome do arquivo que foi gerado (o nome é dinamico então quantas vezes executar ele vai gerando saídas, caso queiram modificar os dados de entrada para testar)
5. A saída do relatório que foi escrita no arquivo, se concentra em responder as perguntas propostas pelo desafio:
*  Qual quantidade de clientes e de vendedores
informados na entrada?
* Qual a  média salarial dos vendedores?
* Qual o  ID da venda mais cara?
* Qual  o pior vendedor ?

## Estrutura de dados adotada
Para que a aplicação tenha sucesso em analisar e processar os dados, é necessário respeitar a estrutura descrita abaixo (as linhas são delimitadas por ";":


| Entidade   |      ID      |  FORMATO | Exemplo  |
|----------|:-------------:|------:|------:|
| Salesman |  001 | 001,CPF,Name,Salary; |001,71060867036,Joana,5000;|
| Customer |    002   |  002,CNPJ,Name,Business Area; | 002, 93812510000144, Orange Dev, TI;|
| Sales | 003 |    003,Sale ID,[ item_dsc  \| item_id \| item_qtd\|item_price],Salesman ID; | 003,1,[Hat\|1\|5\|100],69251226083;|

# Finalização
Em resumo, a implementação foi esta. Em caso de dúvidas sobre qualquer trecho de código ou implementação, estou a disposição no meu contato pessoal. Desde já agradeço a oportunidade e o desafio foi bem legal também. Espero que possamos avançar para um acordo.

