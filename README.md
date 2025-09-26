## Requisitos para rodar

- PHP 8.2 ou superior
- Composer 2.0 ou superior
- MySql

## Como executar

- Primeiramente deve verificar se as versões do PHP e do Composer estão nas recomendadas: php -v && composer -v
- Depois dar um git clone no repositório: git clone <link-repositorio>
- Alterar os dados referentes ao banco de dados no arquivo `.env`
```
Exemplo do código ja formatado

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loja_virtual
DB_USERNAME=root
DB_PASSWORD=070506
```
- Logo depois de configurar a conexão com o banco é necessário criar as tabelas usando o comando: `php artisan migrate`
```
Provavelmente retornará um comando pareciido em caso de êxito

0001_01_01_000000_create_users_table .................................................................. 83.94ms DONE
0001_01_01_000001_create_cache_table .................................................................. 24.39ms DONE
0001_01_01_000002_create_jobs_table ................................................................... 64.39ms DONE
2025_09_26_114237_create_personal_access_tokens_table ................................................. 53.47ms DONE
2025_09_26_114707_create_products_table ............................................................... 18.00ms DONE
2025_09_26_114735_create_sales_table .................................................................. 46.61ms DONE
```
## Endpoints do sistema
