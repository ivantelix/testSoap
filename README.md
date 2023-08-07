# testSoap
Implementacion de un service SOAP basico para procesar las peticiones realizadas por una Rest Api

### Funcionalidades:
- Registro de clientes
- Consulta de saldo
- Recarga de saldo
- Pago y Confirmacion de pago

### Configuracion del service SOAP

- Clonar y posicionarse en la raiz del directorio soapLaravelServer
- ejecutar los siguientes comandos:
-   - composer install
    - renombrar .env-example a .env
    - php artisan sail:install -> aca seleccionar mysql
    - ./vendor/bin.sail up -d
    - ./vendor/bin/sail artisan migrate
    - acceder a la url: http://localhost para validar que el servidor se ejcuto de forma correcta
    - Configurar las variables para mailing enel archivo .env
 
### Confirguracion del Servicio Rest
- Posicionarse en la raiz del directorio restClient
- ejecutar los siguientes comandos:
-   - composer install
    - php -S localhost:8000 -t public luego acceder a la url: http://localhost:8000

Ya con esto deberias tener ejecutandose ambos entornos. Como opcion en caso que te muestre algun error con el paquete soap de php, 
podrias ejecutar el siguiente comando:

- sudo apt-get install php-soap

Pruebas realizadas con postman.
