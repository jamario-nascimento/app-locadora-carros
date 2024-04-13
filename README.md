
## Projeto Locadora de carros

- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.


### Generates

```php artisan make:model --migration --controller --resource Marca```  

```php artisan make:model -mcr Modelo``` - comando cria Model, Controller, Migration.  

```php artisan make:model --all Carro``` - comando cria Model, Controller, Migration, Factory, Seeder.  

```php artisan make:model -a Cliente``` - versão abreviada --all  

```php artisan make:model -a Locacao```  


```php artisan storage:link``` - comando permite acesso aos arquivos resources como imagens feitas pelo upload.  


## JWT

### Instalando biblioteca
```composer require tymon/jwt-auth "1.0.2"``` -instalando biblioteca JWT para php  


### Configuração JWT

- **[jwt-auth documentation](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)**

```php artisan jwt:secret``` - Gerando secret  

```php artisan make:controller AuthController``` 

## FrontEnd do projeto 

Apartir daqui vamos criar nosso frontend em Vue Js

### Instalando pacote UI para intarface do nosso sitema 

```composer require laravel/ui:^3.2.1``` 

### Gerar esqueleto do projeto com Vue JS e autenticação nativa(scaffold / esqueleto)

```php artisan ui vue --auth``` 

### Bixando dependencias e produzindo o bundle de front-end 

```npm install && npm run dev``` 