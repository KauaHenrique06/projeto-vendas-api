## Requisitos para rodar

- PHP 8.2 ou superior
- Composer 2.0 ou superior
- MySql

## Como executar

- Primeiramente deve verificar se as versões do PHP e do Composer estão nas recomendadas: php -v && composer -v
- Depois dar um git clone no repositório: git clone https://github.com/KauaHenrique06/projeto-vendas-api.git
- Copie o arquivo .env.example e coloque o nome .env
- Dar o comando `php artisan key:generate` para liberar acesso para rodar o sistema com o comando `php artisan serve`
- Dar o comando `composer install` para instalar as dependências do projeto
- Alterar os dados referentes ao banco de dados no arquivo `.env`
- Rodar o comando `php artisan db:seed` para ja criar os tipos de usuário do sistema 

Código gerado como padrão
```
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306  
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Exemplo do código ja formatado
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loja_virtual //com o nome que preferir
DB_USERNAME=root //nome de usuário do banco
DB_PASSWORD=070506 //senha cadastrada no banco (caso possua uma)
```

- Logo depois de configurar a conexão com o banco é necessário criar as tabelas usando o comando: php artisan migrate
- Provavelmente retornará um comando pareciido em caso de êxito
```
  0001_01_01_000000_create_users_table ................................................................................................ 98.40ms DONE
  0001_01_01_000001_create_cache_table ................................................................................................ 33.09ms DONE
  0001_01_01_000002_create_jobs_table ................................................................................................. 74.50ms DONE
  2025_09_26_114237_create_personal_access_tokens_table ............................................................................... 73.87ms DONE
  2025_09_26_114707_create_products_table ............................................................................................. 15.05ms DONE
  2025_10_08_222512_create_user_types_table ........................................................................................... 22.61ms DONE
  2025_10_08_224038_add_user_type_foreign_id_for_users ................................................................................ 38.10ms DONE
  2025_10_10_033741_create_sales_table ................................................................................................ 81.33ms DONE
  2025_10_10_054758_create_orders_table ............................................................................................... 86.78ms DONE
```
## Endpoints

### Usuário
- http://127.0.0.1:8000/api/auth/register
```
{
    "name": "jonas",
    "email": "jonas1@gmail.com",
    "password": "123123",
    "password_confirmation": "123123"
}

{
    "user": {
        "name": "string",
        "email": "string",
        "updated_at": "string",
        "created_at": "string",
        "id": 0
    },
    "registrado": true,
    "token": "string"
}
```
- http://127.0.0.1:8000/api/auth/login
```
{
    "email": "jonas1@gmail.com",
    "password": "123123"
}

{
    "user": {
        "id": 0,
        "name": "string",
        "email": "string",
        "email_verified_at": null,
        "created_at": "string",
        "updated_at": "string"
    },
    "loggado": true,
    "token": {
        "accessToken": {
            "name": "string",
            "abilities": [
                "string"
            ],
            "expires_at": null,
            "tokenable_id": 0,
            "tokenable_type": "string",
            "updated_at": "string",
            "created_at": "string",
            "id": 0
        },
        "plainTextToken": "string"
    }
}
```
### Produtos
- http://127.0.0.1:8000/api/product/store
```
{
    "name": "arroz",
    "price": "19.90",
    "quantity": "20"
}

{
    "error": false,
    "message": "produto adicionado com sucesso",
    "data": {
        "name": "arroz",
        "price": "19.90",
        "quantity": "20",
        "updated_at": "2025-10-09T18:50:39.000000Z",
        "created_at": "2025-10-09T18:50:39.000000Z",
        "id": 1
    },
    "status": 200
}
```
- http://127.0.0.1:8000/api/product/{id}
```
{
    "error": false,
    "message": "produto excluido com sucesso",
    "data": true,
    "status": 200
}
```
- http://127.0.0.1:8000/api/product/{id}
```
{
    "error": false,
    "message": "produto atualizado com sucesso",
    "data": {
        "id": 1,
        "name": "feijão",
        "price": "12.90",
        "quantity": "6",
        "created_at": "2025-10-09T19:06:45.000000Z",
        "updated_at": "2025-10-09T19:06:52.000000Z"
    },
    "status": 200
}
```
- http://127.0.0.1:8000/api/product/quantity/{id}
```
{
    "quantity": 34
}

{
    "error": false,
    "message": "quantidade atualizado com sucesso",
    "data": {
        "id": 1,
        "name": "arroz",
        "price": "19.90",
        "quantity": 34,
        "created_at": "2025-10-11T00:05:55.000000Z",
        "updated_at": "2025-10-11T00:06:23.000000Z"
    },
    "status": 200
}
```
- http://127.0.0.1:8000/api/product/get
```
{
    "error": false,
    "message": "lista de produtos",
    "data": [
        {
            "id": 1,
            "name": "arroz",
            "price": "19.90",
            "quantity": 20,
            "created_at": "2025-10-09T23:43:09.000000Z",
            "updated_at": "2025-10-09T23:43:09.000000Z"
        },
        {
            "id": 2,
            "name": "feijao",
            "price": "19.90",
            "quantity": 20,
            "created_at": "2025-10-09T23:43:14.000000Z",
            "updated_at": "2025-10-09T23:43:14.000000Z"
        }
    ],
    "status": 200
}
```
### Vendas
- http://127.0.0.1:8000/api/sale/store
