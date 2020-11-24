# Desafio programação - para vaga desenvolvedor PHP

![agora](http://shipsmart.com.br/assets/img/logo.png)


Por favor leiam este documento do começo ao fim, com muita atenção.
O intuito deste teste é avaliar seus conhecimentos técnicos, para ser mais específico em PHP.

1. Usando docker (pode usar o laradocker) para configurar um ambiente, desenvolva um CRUD
usando PHP Puro, onde você irá realizar o cadastro de itens para uma caixa. Neste cadastro deve
conter os seguintes campos: SKU (codigo alphanumerico único, sem aceitar simbolos, e letras
sempre maiúsculas), Descrição, Nome (todos os nomes devem ser registrados sem acento e em
minúsculo), valor (campo com mascara de moeda), moeda (a moeda que será paga o valor do
produto: USD, BRL, EUR) e peso (em Kilograma, com mascara, e com 3 casas decimais após a
vírgula, fazendo assim 1,000 = 1 Kg)

a) Os dados tem que ser salvos em um banco relacional (mysql) e um não relacional (mongo) ao mesmo tempo!

b) Quando o dado for editado, tem que ser editado nas duas bases ao mesmo tempo!

c) A listagem dos produtos em tela, tem que ser dos dados gravados do banco não relacional!

Depois de feito, sua seu código para algum repositorio git online (bitbucket ou github por exemplo)
e nos envie apenas os links do(s) repositorio(s) , com quaisquer instruções para instalação que achar
necessário.

# Instalação das Ferramentas

**Mysql e Phpmyadmin**

1. Mysql 
```
sudo docker run -d \
-p 3306:3306 \
--name=mariadb \
--restart=always \
-v /etc/localtime:/etc/localtime:ro \
-e MYSQL_ROOT_PASSWORD=123456 \
-v /storage/mariadb:/var/lib/mysql \
mariadb:latest
```
2. Phpmyadmin
```
sudo docker run -d \
--restart=always \
--name=myadmin \
-v /etc/localtime:/etc/localtime:ro \
--link mariadb:db \
-p 8180:80 \
phpmyadmin/phpmyadmin
```
3. Criar schema 'shipsmart' e a Tabela 'itens'

```
CREATE TABLE `itens` (
  `sku` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `moeda` varchar(255) NOT NULL,
  `peso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```
**Mongodb e Mongo Express**

1. Mongodb
```
sudo docker run -d \
--name=mongodb \
--restart=always \
-p 27017:27017 \
-v /etc/localtime:/etc/localtime:ro \
-v /storage/mongodb:/data/db \
mongo:latest
```
2. Mongo Express

```
sudo docker run -it --rm \
    --name mongo-express \
    --link mongodb:mongo \
    -p 8081:8081 \
    -e ME_CONFIG_OPTIONS_EDITORTHEME="ambiance" \
    -e ME_CONFIG_BASICAUTH_USERNAME="user" \
    -e ME_CONFIG_BASICAUTH_PASSWORD="123456" \
    mongo-express
```
3. Criar uma Collections 'shipsmart'

**Aplicação em PHP**

1. Primeiro, faça clone deste projeto em sua maquina no local.
2. Configure o banco de dados dts/dbaSis.php com o banco local da sua máquina no Docker

```
Dockerfile já está na raiz da pasta para o build.
```

```
sudo docker build -t ship .
```

```
sudo docker run -d -p 8000:80 -v /etc/localtime:/etc/localtime:ro -v /LOCAL-DO-PROJETO:/var/www/html --name=my-app --restart=always ship
```

tmj! 