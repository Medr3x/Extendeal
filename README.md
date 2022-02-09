# Extendeal

# Requiremientos del Servidor

    - Laravel 8 & MySQL
    - PHP >= 7.4

# Instalación

    git clone https://github.com/Medr3x/extendeal.git extendeal
    composer install
    cp example.env .env
    php artisan key:generate

# Editar .env

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_name
    DB_USERNAME=db_username
    DB_PASSWORD=db_password
     
# Luego ejecutar

    php artisan migrate:fresh --seed

# Rutas APIRestFull

# STATUS - GET: http://extendeal.test:8080/api/
desc: Devuelve el tiempo de respuesta. 

# LIST - GET: http://extendeal.test:8080/api/painting?filters[country]=Argentina&fields=id,name,painter,code
- filters: Agregar columnas por las cuales se quiere filtrar. Si no existe la ignora.
- fields: Si no se especifica ninguna columna, se muestra el contenido original. Si se manda una columna inexistente, la ignora.
- page: Los resultados son paginados, si se quiere recorrer los resultados de las paginas se debe mandar page={num de pag} como parametro en el header. 
  Ej: http://extendeal.test:8080/api/painting?page=2&fields=id,name,painter,codee

# SHOW - GET: http://extendeal.test:8080/api/painting/1
- Se debe indicar el id del cuadro para que pueda ser mostrado 

# CREAR - POST: http://extendeal.test:8080/api/painting
- se debe generar un body con la siguiente esteructura:
Ej:
{
	"name": "Demo",
	"code": "Test",
	"painter": "Medero",
	"country": "Argentina",
	"publication_date": "2022-02-08",
	"status": 1,
	"relevance": 1,
}

*** NOTA: Solo se insertaran los datos mostrados en el json de ejemplo, si se envia: "created_by": 5 este sera ignorado. ***
*** NOTA: Created By: se tomara el id enviado en el X-HTTP-USER-ID. ***

# ACTUALIZAR - PUT: http://extendeal.test:8080/api/painting/1
- se debe especificar el id del cuadro a actualizar.
- se debe generar un body con la siguiente esteructura:
Ej:
{
	"name": "Demo",
	"code": "Test",
	"painter": "Medero",
	"country": "Argentina",
	"publication_date": "2022-02-08",
	"status": 1,
	"relevance": 1,
}

*** NOTA: Solo se insertaran los datos mostrados en el json de ejemplo, si se envia: "created_by": 5 este sera ignorado. ***
*** NOTA: Updated By: se tomara el id enviado en el X-HTTP-USER-ID. ***

# ELIMINAR - DEL: http://extendeal.test:8080/api/painting/1
- Se debe especificar el id del cuadro a eliminar
- En updated by se guardara la persona que lo elimino logicamente.
- Se usa soft delete, ya que se deberian borrar registros. Es solo un borrado logico.

# Herramienta de Desarrollo Local: LARAGON

    