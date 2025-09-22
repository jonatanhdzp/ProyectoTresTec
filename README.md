# Prueba Técnica Tres-Tec

## Tecnologías utilizadas

-   **PHP 8.3**
-   **Laravel 12**
-   **MySQL**
-   **Composer**
-   **Bootstrap 5.3**
-   **Docker + docker-compose**
-   **WSL2 (Ubuntu)**

---

## Instalación del Proyecto

Toda la instalación se debe hacer mediante Ubuntu (WSL).

### Paso 1. Clonar el repositorio

```bash
git clone https://github.com/jonatanhdzp/ProyectoTresTec.git
cd ProyectoTresTec
```

### Paso 2. Instalar dependencias de PHP

```bash
composer install
```

Si aparece el error:

```bash
vendor/composer does not exist and could not be created
```

Ejecuta:

```bash
sudo chown -R tu_usuario:tu_usuario /ruta/a/ProyectoTresTec
```

y luego repite:

```bash
composer install
```

### Paso 3. Crear archivo de entorno (.env)

```bash
cp .env.example .env
```

### Paso 4. Configurar .env

Hay que editar estas variables dentro del archivo

```bash
APP_LOCALE=es

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=proyectotrestec
DB_USERNAME=sail
DB_PASSWORD=password
```

### Paso 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### Paso 6. Levantar los contenedores con Sail

```bash
./vendor/bin/sail up -d
```

### Paso 7. Ejecutar migraciones

```bash
./vendor/bin/sail artisan migrate
```

Con esto, el proyecto ya estará listo para usar.

Para probar la página con datos ficticios, utilizar este comando

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

## Estructura del Proyecto

### Controladores Web

-   **ClientController**
    -   **index** - Listado con filtros, paginación y vista **client.index**.
    -   **store** - Creación de cliente con validación (**StoreClientRequest**).
    -   **show** - Visualización de un cliente + contratos paginados (3 por página).
    -   **update** - Actualización con validación (**UpdateClientRequest**).
    -   **destroy** - Eliminación con retorno al listado manteniendo filtros.
-   **ContractController**
    -   **destroy** - Eliminación con retorno al listado de clientes.

### Controladores API REST

-   **ClientApiController**
    -   **index** - Retorna un JSON con todos los clientes y sus contratos.
-   **ContractApiController**
    -   **store** - Crea un contrato asociado a un cliente existente, con validación (**StoreContractRequest**).

### Requests

-   **StoreClientRequest**
    -   Validaciones: **name, email** (único), **phone** (opcional).
-   **StoreContractRequest**
    -   Validaciones: **client_id, contract_number** (único, rango 10000-99999), **amount, starts_at, ends_at** (>= starts_at).
-   **UpdateClientRequest**
    -   Validaciones: **name, email** (único), **phone** (opcional).

### Modelos

-   **Client**: **fillable = [name, email, phone]**, relación **hasMany(Contract)**.
-   **Contract**: **fillable = [client_id, contract_number, amount, starts_at, ends_at]**, relación **belongsTo(Client)**.

### Base de datos

-   **Migraciones**
    -   **clients**: id, name, email único, phone nullable, timestamps.
    -   **contracts**: id, client_id (FK con cascade delete), contract_number único, amount decimal, fechas inicio/fin.
-   **Factories**
    -   **ClientFactory**: genera clientes falsos.
    -   **ContractFactory**: genera contratos aleatorios, validando fechas.
-   **Seeders**
    -   **DatabaseSeeder**: crea 10 clientes con 3 contratos asociados.

### Vistas

-   **home.blade.php** - Pantalla de inicio.
-   **client/index.blade.php** - Listado de clientes, buscador, tabla, botones ver/eliminar, formulario en dropdown para añadir cliente.
-   **client/show.blade.php** - Detalles de cliente + contratos.
-   **Layouts** - **defaultHtml.blade.php** con Bootstrap, navbar, footer y alerts automáticas.
-   **Componentes** - **dropdownForm**, **navbar**, **footer**.

### Recursos

-   **CSS**: estilos para alerts y dropdowns.
-   **JS**: dismiss automático de alerts (7.5s).

### Rutas Web

```php
Route::get('/', function () {
    return view('home')
})->name('home');

Route::resource('clientes', ClientController::class)
    ->parameters(["clientes" => "client"])
    ->names('client')
    ->except(['create', 'edit']);

Route::resource('contratos', ContractController::class)
    ->parameters(["contratos" => "contract"])
    ->names('contract')
    ->only('destroy');
```

### Rutas API

```php

Route::get('/clients', [ClientApiController::class, 'index']);
Route::post('/contracts', [ContractApiController::class, 'store']);

```
