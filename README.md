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

## Estructura del Proyecto

### Controladores

-   **ClientController**
    -   **index** - Listado con filtros, paginación y vista **client.index**.
    -   **store** - Creación de cliente con validación (**StoreClientRequest**).
    -   **show** - Visualización de un cliente + contratos paginados (3 por página).
    -   **update** - Actualización con validación (**UpdateClientRequest**).
    -   **destroy** - Eliminación con retorno al listado manteniendo filtros.
-   **ContractController**
    -   **destroy** - Eliminación con retorno al listado de clientes.

### Requests

-   **StoreClientRequest**
    -   Validaciones: **name, email** (único), **phone** (opcional).
-   **StoreContractRequest**
    -   Validaciones: **client_id, contract_number** (único, rango 10000-99999), **amount, starts_at, ends_at** (>= starts_at).

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

### Rutas

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
