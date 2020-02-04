Para execução do projeto estou utilizando Apache 2.4 e PHP 7.2 configurados no WampServer 3.1

Criei um banco de dados em MySQL no phpMyAdmin para salvar as atividades favoritas do usuário.

Dentro da pasta "api", na pasta "conf", há um arquivo chamado "configuration.php", nele está configurado o acesso ao banco de dados, onde estou utilizando o servidor "localhost", usuário "root", senha em branco "" e nome do banco de dados "hvex". Caso utilize configurações diferentes de conexão com banco de dados, basta alterar esse arquivo.

Dentro da pasta "api", na pasta "sql", há um arquivo chamado "create.sql", onde, basta criar um banco de dados chamado "hvex" (caso utilize outro nome, lembre-se de alterar o arquivo "configuration.php" citado acima) e executar o script salvo no arquivo ou importa-lo.

Dentro da pasta "web", na pasta "conf", há um arquivo chamado "server.php". Nesse arquivo há uma variável chamada "server", no qual está salvo o caminho para a aplicação acessar a API, onde, está utilizando o endereço "http://localhost/hvex/" (dentro de uma pasta chamada "hvex" em meu diretório público), caso salve a aplicação em uma pasta diferente, basta alterar o valor da variável para o caminho de sua máquina.

Utilizei o Insomnia para fazer os teste na API. A API responde as seguintes requisições:

GET    api/activity/list                      -> trás todas as atividades;

GET    api/activity/list?key_activity=chave   -> trás a atividade de chave especificada na URL;

POST   api/activity/create                    -> salva no banco de dados uma atividade vinda por POST de nome "key_activity" contendo a chave como valor;

DELETE api/activity/delete?key_activity=chave -> deleta uma atividade de chave especificada na URL.

OBS.: 
1 - Como a descrição das atividades estão em inglês, optei por deixar toda a aplicação também em inglês, para não ficar parte em português e parte em inglês.
2 - O usuário pode salvar uma atividade gerada aleatóriamente e deixar de salvar a mesma. Se na hora do sorteio apresentar uma atividade já salva em favoritos, a aplicação identifica e a apresenta como salva (ícone do coração preenchido), dando a opção do usuário deixar de salvar.
3 - Iria fazer a aplicação utilizando React, porém, como ainda estou aprendendo, optei por utilizar PHP, que tenho mais conhecimento, evitando assim um atraso na entrega.