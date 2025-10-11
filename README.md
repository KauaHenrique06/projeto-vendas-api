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
##