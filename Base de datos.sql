CREATE DATABASE sis_inventario;
USE sis_inventario;

CREATE TABLE cat_perfil(
id_perfil INT NOT NULL PRIMARY KEY,
descripcionperfil VARCHAR(40)NOT NULL UNIQUE);

CREATE TABLE cat_usuario(
id_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
usuario CHAR(15)NOT NULL,
nombre CHAR(15) NOT NULL,
apellidoP CHAR(20) NOT NULL,
apellidoM CHAR(20) NOT NULL,
telefono BIGINT NOT NULL,
correo VARCHAR(70) NOT NULL,
contrasena VARCHAR(25) NOT NULL,
id_perfil int NOT NULL,
estatus INT NOT NULL DEFAULT 1,
FOREIGN KEY (id_perfil) REFERENCES cat_perfil(id_perfil));

CREATE TABLE cat_area(
id_area INT NOT NULL PRIMARY KEY ,
descripcion VARCHAR(25)NOT NULL,
estatus INT NOT NULL);

CREATE TABLE cat_tipo_producto(
id_tipo INT NOT NULL PRIMARY KEY,
descripciontipo varchar(30)NOT NULL,
id_area INT NOT NULL,
estatus INT NOT NULL,
FOREIGN KEY (id_area) REFERENCES cat_area(id_area));


CREATE TABLE cat_marca(
id_marca INT NOT NULL PRIMARY KEY,
descripcionmarca VARCHAR(25)NOT NULL,
estatus INT NOT NULL);

CREATE TABLE cat_proveedor(
id_proveedor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
razon_social VARCHAR(30) ,
telefono BIGINT NOT NULL,
id_area INT NOT NULL,
estatus INT NOT NULL default 1,
FOREIGN KEY (id_area) REFERENCES cat_area(id_area)
);


CREATE TABLE cat_producto(
id_producto INT NOT NULL auto_increment PRIMARY KEY,
descripcionproducto VARCHAR(50)NOT NULL,
cantidad INT NOT NULL,
id_marca INT NOT NULL,
modelo VARCHAR(30)NOT NULL,
serie CHAR (30)NOT NULL,
precio INT NOT NULL,
id_usuarioalta INT NOT NULL,
id_usuariobaja INT  NULL,
id_tipo INT NOT NULL,
fh_alta DATETIME NOT NULL, 
fh_baja DATETIME  NULL,
id_proveedor INT NOT NULL,
estatus INT NOT NULL DEFAULT 1,
FOREIGN KEY (id_tipo) REFERENCES cat_tipo_producto(id_tipo),
FOREIGN KEY (id_usuarioalta) REFERENCES cat_usuario(id_usuario),
FOREIGN KEY (id_usuariobaja) REFERENCES cat_usuario(id_usuario),
FOREIGN KEY (id_marca) REFERENCES cat_marca(id_marca),
FOREIGN KEY (id_proveedor) REFERENCES cat_proveedor(id_proveedor)
);


CREATE TABLE cat_salon(
id_salon INT NOT NULL PRIMARY KEY auto_increment,
descripcion VARCHAR(15)NOT NULL,
estatus INT NOT NULL DEFAULT 1);


CREATE TABLE cat_cliente(
id_cliente INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nombre CHAR(30) NOT NULL,
apellidoP CHAR(30) NOT NULL,
apellidoM CHAR(30) NOT NULL,
telefono BIGINT NOT NULL,
id_area INT NOT NULL,
estatus INT NOT NULL DEFAULT 1,
FOREIGN KEY (id_area) REFERENCES cat_area(id_area)
);




CREATE TABLE cat_estado_prestamo(
id_catalogo int primary key,
descripcion varchar(25)
);


CREATE TABLE log_prestamo_det(
id_prestamo INT NOT NULL,
linea INT NOT NULL ,
fh_prestamo DATETIME NULL,
id_producto INT NOT NULL,
cantidad INT NOT NULL,
id_cliente INT NOT NULL,
id_usuario_prestamo INT  NULL,
fh_actualiza INT  NULL,
id_tipo_actualiza INT  NULL,
id_usuario_actualiza INT  NULL,
id_estatus_det INT  NULL,
FOREIGN KEY (id_producto) REFERENCES cat_producto(id_producto),
FOREIGN KEY (id_cliente) REFERENCES cat_cliente(id_cliente),
FOREIGN KEY (id_usuario_prestamo) REFERENCES cat_usuario(id_usuario),
FOREIGN KEY (id_tipo_actualiza) REFERENCES cat_estado_prestamo(id_catalogo),
FOREIGN KEY (id_usuario_actualiza) REFERENCES cat_usuario(id_usuario),
primary key(id_prestamo, linea));


CREATE TABLE log_prestamo_cab(
id_prestamo INT NOT NULL PRIMARY KEY ,
fh_prestamo DATETIME NULL,
fh_cierre DATETIME NULL,
costo_total INT NOT NULL,
id_salon INT NOT NULL,
id_estatus INT NOT NULL,
FOREIGN KEY (id_salon) REFERENCES cat_salon(id_salon));


CREATE TABLE detalle_temporal_pres(
id_detalle_temp INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_cliente INT NOT NULL,
id_usuario INT NOT NULL,	
id_salon INT NOT NULL,
id_producto INT NOT NULL,
cantidad INT NOT NULL,
fh_prestamo DATETIME  NULL,
FOREIGN KEY (id_cliente) REFERENCES cat_cliente(id_cliente),
FOREIGN KEY (id_usuario) REFERENCES cat_usuario(id_usuario),
FOREIGN KEY (id_salon) REFERENCES cat_salon(id_salon),
FOREIGN KEY (id_producto) REFERENCES cat_producto(id_producto));


CREATE table cat_contador(
id_contador int(5) primary key ,
descripcion varchar(30),
var_num INT(5),
valor_min INT (5),
valor_max INT (5)
);