## Ejecutar el Proyecto
1.- Abrir la terminal
2.- En la terminal posicionarse en la ruta del proyecto
3.- En la terminal escribir: php artisan serve


## Script de Base de Datos

CREATE DATABASE `tendencys`;

CREATE TABLE `tendencys`.`catalog_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` longtext DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tendencys`.`users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `img_profile` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tendencys`.`access_tokens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `token` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`));

  ALTER TABLE `tendencys`.`access_tokens` 
ADD CONSTRAINT `user_access_token`
  FOREIGN KEY (`user_id`)
  REFERENCES `tendencys`.`users` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

## NOTA:
		*Agregar el Header de Accept : application/json en las peticiones.

		

## Crear Usuario y Obtener Token
1.- Crear usuario:
	Ruta:http://127.0.0.1:8000/api/register
	Tipo:POST
	Parámetros:
		{
		    "name":"tendencys",
		    "phone":"4444233445",
		    "img_profile":""
		}
2.- Obtener el token:
	Ruta:http://127.0.0.1:8000/api/login
	Tipo:POST
	Parámetros:
		{
		    "name":"tendencys",
		    "phone":"4444233445",
		    "img_profile":""
		}


## Acceder al CRUD de Productos
1.- Crear Producto:
	Ruta:http://127.0.0.1:8000/api/products
	Tipo:POST
	Parámetros:
		{
			"name": "Producto 1",
		    "description": "Producto de Prueba",
		    "height": 20,
		    "length": 20,
		    "width": 20
		}
2.- Obetener todos los Productos:
	Ruta:http://127.0.0.1:8000/api/products
	Tipo:GET

3.- Obetener un Producto:
	Ruta:http://127.0.0.1:8000/api/products/<id>
	Tipo:GET

4.- Actualizar un Producto:
	Ruta:http://127.0.0.1:8000/api/products/<id>
	Tipo:PUT
	Parámetros:
		{
			"name": "Producto 1",
		    "description": "Producto Actualizado",
		    "height": 20,
		    "length": 20,
		    "width": 20
		}

5.- Eliminar un Producto:
	Ruta:http://127.0.0.1:8000/api/products/<id>
	Tipo:DELETE



