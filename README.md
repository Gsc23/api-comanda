<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


API - Comanda Eletrônica [ Em-Desenvolvimento ]
========================

Esta API foi desenvolvida com Laravel para facilitar o gerenciamento de comandas em ambientes como bares e restaurantes. O sistema permite o controle interno de pedidos, produtos e usuários, promovendo agilidade no atendimento e organização nas operações.

* * *

Funcionalidades
---------------

*   Autenticação de Usuários: Registro e login de funcionários com segurança.
*   Cadastro de Usuários: Criação, atualização e exclusão de perfis de usuários.
*   Gerenciamento de Pedidos: Associar produtos a comandas, editar ou excluir pedidos.
*   Cadastro de Produtos: Inserção e manutenção dos produtos disponíveis para venda.
*   Relatórios: Geração de relatórios de consumo e vendas para controle gerencial.

* * *

Tecnologias Utilizadas
----------------------

*   [Laravel](https://laravel.com/) – Framework PHP para desenvolvimento backend.
*   [MongoDB](https://www.mongodb.com/) – Banco de dados não relacional, ideal para dados dinâmicos.
*   [Docker](https://www.docker.com/) – Containerização da aplicação, facilitando a replicação do ambiente.
*   [Swagger](https://swagger.io/) – Documentação interativa da API para facilitar o uso e integração.

* * *

Pré-requisitos
--------------

Certifique-se de ter as seguintes ferramentas instaladas na sua máquina:

*   [Docker](https://www.docker.com/get-started)
*   [Docker Compose](https://docs.docker.com/compose/install/)

* * *

Instalação e Execução
---------------------

1.  Clone o repositório:
    
        git clone https://github.com/Gsc23/api-comanda.git
    
2.  Acesse o diretório do projeto:
    
        cd api-comanda
    
3.  Configure o ambiente:
    
        cp .env.example .env
    
4.  Suba os containers com o Docker:
    
        docker-compose up --build
    
5.  Instale as dependências do Laravel:
    
        docker-compose exec app composer install
    
6.  Gere a chave da aplicação:
    
        docker-compose exec app php artisan key:generate
    
7.  Execute as migrações:
    
        docker-compose exec app php artisan migrate
    

* * *

Acesso à API
------------

Após a instalação, a aplicação estará disponível em:

    http://localhost:8000/api

Documentação via Swagger:

    http://localhost:8000/api/documentation

* * *

Contribuições
-------------

Contribuições são bem-vindas! Sinta-se à vontade para abrir **issues**, propor **pull requests** ou sugerir melhorias.

* * *
