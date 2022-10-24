# Portfólio - Interpretador do retorno CNAB
Sistema desenvolvido em PHP com o objetivo de interpretar o retorno CNAB.

## Banco de dados

Este projeto foi desenvolvido para utilizar uma conexão com um banco de dados MySQL, para configurar o banco de dados, utilize o script que esta na pasta database. 

O script (portfolio-interpretation-cnab.sql) poderá ser utilizado para criar o banco de dados com todas as tabelas do projeto e com alguns registros fictícios.

### Configurando a string de conexão com o banco

Após criar o seu banco de dados local, é necessário configurar a string de conexão com o seu banco para que a aplicação funcione.

```bash
   Altere a string de conexão no arquivo InterpretationDAO.php
```

## Rodando os projeto

Para rodar o projeto, inicie o servidor PHP.
Exemplo:

```bash
   php -S localhost:8000
```

Após isso acesse o endereço em seu navegador e será apresentada a aplicação:

![Logo](https://i.postimg.cc/9Mqjf4WY/interpretador-retorno-cnab-01.png)

![Logo](https://i.postimg.cc/NFqv2gFq/interpretador-retorno-cnab-02.png)

