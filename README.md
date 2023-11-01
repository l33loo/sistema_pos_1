# SISTEMA DE POS ONLINE

## Grupo
Gonçalo Gregório
Lila Karpowicz
Miguel Gil

## PARTE I – REGISTO DE INFORMAÇÃO

### ENQUADRAMENTO

Um sistema PoS (Point of Sale) realiza tarefas de gestão de artigos e clientes, bem como a venda de
artigos, sendo esta feita através de leitura de códigos de barras EAN13. Um código EAN13 consiste
numa cadeia de caracteres com 13 algarismos, sendo que os 12 primeiros identificam o artigo e o 13º é
um algarismo de controlo para garantir a correta leitura do código.

O sistema PoS a implementar deve permitir adicionar artigos e clientes, e realizar vendas de artigos a
clientes gerando para tal um talão contendo os artigos de cada compra e o total.

A cada cliente pode ser aplicado um desconto mínimo de 0% (cliente sem desconto) e máximo de 15%,
desconto este que será aplicado ao total de cada venda feita ao cliente.

Podem ainda ser configuradas campanhas de artigos aplicando descontos mediante a data da venda ou
a quantidade comprada, isto é, entre a data X e Y o artigo terá Z% de desconto, ou ainda na compra de
10 unidades ou mais, aplicar desconto de 5%. Não é permitida a acumulação de descontos, isto é, se um
cliente já tiver 15% de desconto, não pode usufruir de descontos em artigos.

### REQUISITOS

#### RF1 – REGISTO DE CLIENTE

Toda a informação relativa aos clientes está armazenada num ficheiro de texto (no formato CSV) com o
nome clientes.txt. Cada linha contém a informação relativa a um cliente, sendo esta caracterizada
pelos seguintes campos:
1. Código de Cliente: inteiro sequencial único a cada cliente
2. Nome de Cliente: cadeia de caracteres
3. Número de Identificação Fiscal (NIF): cadeira de caracteres de dimensão 9 contendo apenas
dígitos
4. Morada: cadeia de caracteres contendo a rua e o número de porta separados por vírgula (,)
5. Código Postal: cadeia de caracteres no formato XXXX-YYY (em que X e Y são algarismos)
6. Localidade: cadeia de caracteres
7. Desconto: inteiro entre 0 e 15

Elabore um formulário HTML que permita recolher a informação acima mencionada, com exceção do
código de cliente, que é automaticamente gerado pelo sistema de forma sequencial. Este formulário
deve ser processado por um script PHP sendo que a informação introduzida neste formulário deve ser
adicionada ao ficheiro clientes.txt, contendo um cliente por linha com os campos separados por
ponto e vírgula.

Exemplo
`1;Consumidor Final;999999990;;;;0
2;José Melo;123456789;Rua Direita, n8;9500-000;Ponta Delgada; 15`

No registo de cliente, todos os campos são obrigatórios, e deve validar se os campos estão de acordo
com as regras, devolvendo uma mensagem de erro apropriada em cada caso.

O ficheiro de clientes inicialmente contém apenas o cliente consumidor final conforme exemplo acima.

O sistema deverá utilizar sessões PHP autenticação de utilizadores, e apenas utilizadores autenticados
podem aceder a qualquer funcionalidade do sistema

#### RF2 – REGISTO DE ARTIGOS

A base de dados de artigos do sistema está registada num ficheiro de texto (no formato CVS) com nome
artigos.txt. Cada linha do ficheiro contém informação sobre um artigo, sendo esta a seguinte:
1. Código de Artigo: inteiro sequencial único a cada artigo
2. Nome de Artigo: cadeia de caracteres com tamanho máximo de 12 caracteres
3. Preço unitário: valor decimal entre 0 e 9999999
4. Taxa de IVA: Apenas os seguintes valores 0, 4, 9 e 16
5. Código de Barras: cadeia numérica de 13 caracteres

Elabore um formulário HTML que permita recolher a informação acima mencionada, com exceção do
código de artigo, que é automaticamente gerado pelo sistema de forma sequencial. Este formulário
deve ser processado por um script PHP sendo que a informação introduzida neste formulário deve ser
adicionada ao ficheiro artigos.txt, contendo um artigo por linha com os campos separados por
ponto e vírgula.

A inserção do código de barras, tratando-se de um código EAN13 deve permitir apenas a inserção de 12
dígitos entre 0 e 9, sendo o 13º dígito calculado pela função ean13CheckDigit fornecida no anexo a este
enunciado. Lembre-se que não pode haver códigos de barras repetidos. Para tal, o processamento do
seu formulário deve validar se o código inserido já existe no ficheiro de artigos antes de adicionar o
artigo ao ficheiro.

Exemplo de ficheiro de artigos
`1;Diversos;1;16;2825195806668
2;Água 1,5L;0.21;4;4330638180116
3;Água 0,33;0.12;4;2794258951747
O ficheiro de artigos deve conter inicialmente o artigo Diversos, conforme exemplo anterior.`

#### RF3 – VENDA DE ARTIGOS

Para implementar a venda de artigos elabore uma página PHP de nome venda.php, contendo um
formulário do lado esquerdo para inserção do código de barras e quantidade, e uma tabela do lado
direito que irá ter a lista dos artigos em venda, conforme exemplo a seguir.

Ao pressionar o botão Adicionar, o formulário deve ser direcionado para a página venda.php. Caso o
utilizador tenha preenchido o campo código de barras, o script deve procurar no ficheiro
artigos.txt pelo código de barras fornecido e caso o encontre, deve adicioná-lo, com a respetiva
quantidade, ao ficheiro venda.txt

Este ficheiro deve conter, em cada linha, os seguintes campos separados por ponto e vírgula.
1. Código de artigo
2. Nome de artigo
3. Quantidade
4. Preço Unitário
5. Imposto
6. Cliente
7. Desconto

Caso o código de barras não seja encontrado deve ser exibida uma mensagem indicativa da situação.

Após o processamento do formulário de código de barras, deve ler o ficheiro venda.txt e exibir do
lado direito da página a listagem de artigos contidos no ficheiro venda.txt, bem como o total de
cada linha. Este total resulta da multiplicação da quantidade pelo preço unitário.

Exemplo de um ficheiro de venda
`1;Diversos;1;1;16;1;0
2;Água 1,5L;50;0.21;4;1;0
3;Água 0,33;12;0.12;4;2;5`

#### RF4 – SELEÇÃO DE CLIENTE

Cada venda pode ser associada a um cliente. Para tal, deve ser adicionado ao lado esquerdo da página
venda.php um campo para indicar o contribuinte do cliente. Caso este campo esteja preenchido,
deve ser adicionado a linha do cliente correspondente ao ficheiro venda_cliente.txt.

Aquando da apresentação da listagem de artigos, caso exista um cliente no ficheiro
venda_cliente.txt, deve ser indicado os dados do cliente do lado direito, e o total da compra
deve refletir o desconto que o cliente tem direito, conforme exemplo seguinte.

#### RF5 – CAMPANHAS E PROMOÇÕES

As campanhas e podem são definidas indicando o artigo, a data de aplicação, a quantidade, e o
desconto a aplicar. Caso o artigo tenha sempre desconto, a quantidade será 1, caso o desconto apenas
deva ser aplicado em quantidades a partir de X, então a quantidade da campanha deve ser X.

Sempre que for adicionado um artigo à lista, deve ser validado se existe alguma campanha válida para o
mesmo e se for o caso na lista de artigos de venda deve ser preenchida uma coluna desconto com o
desconto que foi aplicado e o preço total deve ser o preço já deduzido o desconto. Caso não exista
campanha, a coluna desconto fica vazia.

Deve construir as páginas HTML para inserir e remover campanhas, utilizando formulários e listagens.
As campanhas devem ser guardadas num ficheiro campanhas.txt, separado por ; com os campos
abaixo indicados.
• Código da campanha
• Código do artigo
• Data de Início
• Data de Fim
• Quantidade
• Desconto

À semelhança dos outros elementos, o código é um inteiro sequencial gerado automaticamente pelo
sistema.

### METODOLOGIA DE DESENVOLVIMENTO

A interface web de qualquer aplicação é apenas isto, uma interface, e como tal devem desenvolver os
requisitos e toda a lógica de forma independente da base de dados, isto é, o processo de adicionar um
artigo deve ser implementado recebendo os dados do artigo e validando os mesmos, e posteriormente
adicionar o mesmo ao ficheiro de texto. A interface web, deve invocar este procedimento fornecendo os
dados recebidos do formulário e nada mais.

A vantagem desta metodologia de desenvolvimento é separar as responsabilidades da interface e da
lógica aplicacional, de forma que a interface possa ser completamente alterada sem qualquer
necessidade de mexer na camada aplicacional, e vice-versa.

Assim sendo deve implementar os scripts PHP relevantes para a interface e para a lógica aplicacional em
pastas diferentes, assim como a base de dados.

### AVALIAÇÃO E ENTREGA

• Trabalho em grupos 2 alunos, se não for possível far-se-á um grupo de 3 alunos
• Entregar até 2 de Janeiro de 2024 às 23:59 via Moodle
• A entrega deverá ser acompanhada de um relatório descrevendo o projeto em geral, as
principais dificuldades e a fundamentação para as escolhas efetuadas.
• O trabalho será avaliado com os seguintes componentes:
o Relatório: 20%
o Apresentação e discussão: 20%
o Aplicação Desenvolvida: 60%
§ Implementação de requisitos: 80%
§ Comentários e regras estilísticas de escrita de código: 20% (https://www.php-
fig.org/psr/psr-2/)