#vistas de tablas
use sis_inventario;
SELECT *FROM cat_cliente;
SELECT *FROM cat_usuario;
SELECT *FROM cat_menu;
SELECT *FROM cat_area;
SELECT *FROM cat_perfil;
SELECT *FROM cat_perfil_menu;
SELECT *FROM cat_marca;		
SELECT *FROM cat_contador;
SELECT *FROM cat_negociacion;
SELECT *FROM cat_producto  order by descripcionproducto ASC;		
SELECT *FROM log_prestamo_cab;
SELECT *FROM log_prestamo_det;
SELECT *FROM detalle_temporal_fact;
SELECT *FROM cat_tipo_producto;
SELECT *FROM cat_salon;
SELECT *FROM cat_proveedor;

SELECT a.id_producto,a.descripcion,a.cantidad,b.descripcionmarca,
                c.nombre, a.modelo, a.serie,a.fh_alta,a.estatus
    FROM cat_producto a,
		cat_marca b,
         cat_usuario c
  WHERE a.id_marca = b.id_marca 
AND a.id_usuarioalta = c.id_usuario
AND a.id_producto = 3;


SELECT a.id_usuario,a.usuario,a.nombre,a.apellidoP,
                a.apellidoM,a.telefono,a.correo,a.contrasena,b.descripcion
                FROM cat_usuario a,
                     cat_perfil b
               WHERE a.id_perfil = b.id_perfil 
                 AND a.id_usuario = id_usuario; 

SELECT *,(SELECT id_menu_sup FROM cat_menu b WHERE b.id_menu=a.id_menu) zzzzzz FROM cat_menu a WHERE estatus=1 order by id_orden asc; 
select * from sys.sys_config;
select * from sys.version;
UPDATE cat_cliente SET id_area=2 WHERE id_cliente=1;
UPDATE cat_menu SET id_menu_sup=0 WHERE id_menu=5;
UPDATE cat_menu SET id_orden=2 WHERE id_menu=5;
#Modificar el nombre de una columna#
ALTER TABLE cat_proveedor CHANGE id_proveedor id_proveedor INT NOT NULL  AUTO_INCREMENT;



SELECT *,
       case id_perfil when 0 then "sin descripcion"
                        when 1 then "patito"
						when 2 then "XXX"
                        when 3 then "yyy"
                        else "zzz" end perfil_desc
  FROM cat_usuario;


SELECT a.id_usuario, a.usuario, a.nombre, a.apellidoP,
       a.apellidoM, a.telefono, a.correo, 
       b.descripcion, a.estatus
  FROM cat_usuario a,
       cat_perfil b
WHERE a.id_perfil = b.id_perfil;

-- Modificar un dato de una tablaGN, CAMBIA ICONOS DEL MENU INTERACTIVO
UPDATE cat_menu SET id_menu="7"WHERE id_menu=6;
select * from cat_menu; 
UPDATE cat_menu SET estatus=0 WHERE id_menu=7;
UPDATE cat_menu SET men_icon="fas fa-regular fa-address-card" WHERE id_menu=1;	
UPDATE cat_menu SET men_icon="fas fa-solid fa-users" WHERE id_menu=2;
UPDATE cat_menu SET men_icon="fas fa-solid fa-user-tie" WHERE id_menu=3;
UPDATE cat_menu SET men_ruta="proveedor.php" WHERE id_menu=5;
UPDATE cat_menu SET men_icon="fas 	" WHERE id_menu=6;


SELECT *FROM cat_menu;
	
-- Insertar un dato en una tabla
INSERT INTO cat_salon(id_salon, descripcion, estatus) values 
(NULL,"Arcos", 1);


-- ELIMINAR DATOS DE UNA TABLA (registros de una tabla)
delete from cat_menu where id_menu=3;
delete  from cat_usuario where id_usuario=1;



-- EDITAR UN CAMPO A UNA TABLA
ALTER TABLE `cat_menu` 
ADD `alias` VARCHAR(140) NULL 
AFTER `title`;  


SELECT *,(SELECT count(1) from cat_menu b WHERE b.id_menu_sup=a.id_menu) hijos 
FROM cat_menu a 
WHERE estatus=1 and id_menu_sup=0
order by id_orden asc; 


SELECT  *FROM cat_salon order by descripcion ASC;
SELECT * FROM cat_producto WHERE estatus=1 and id_menu_sup=8 order by id_orden asc; 


alter table cat_producto modify id_producto INT NOT NULL auto_increment PRIMARY KEY;

SELECT *FROM cat_producto;

describe cat_producto;

SELECT a.id_producto,a.descripcion,a.cantidad,b.descripcionmarca,
a.modelo,a.serie,a.id_usuarioalta,a.id_usuariobaja,c.descripcion
FROM cat_producto a,
   cat_marca b,
   cat_tipo_producto c
WHERE a.id_marca = b.id_marca
AND a.id_producto = id_producto;


/*agrega un campo a una tabla 
ALTER TABLE log_prestamo_cab
ADD id_usuario int;
*/

SELECT *FROM detalle_temporal_fact;
ALTER TABLE detalle_temporal_fact
add descripcion varchar (40);

---------

SELECT a.id_prestamo,a.fh_prestamo,a.fh_entrega,a.costo_completo,
      c.nombre, d.descripcion, a.id_prestamo
      FROM log_prestamo_cab a,
      log_prestamo_det b,
           cat_cliente c,
           cat_salon d
     WHERE a.id_cliente = c.id_cliente 
     AND a.id_salon = d.id_salon
       AND a.id_prestamo = b.id_prestamo;
       ----------------------------
        SELECT d.descripcion,
       (SELECT descripcionproducto from cat_producto where id_producto  = b.id_producto) as Producto,	
       (SELECT id_producto from cat_producto where id_producto  = b.id_producto),
       (SELECT id_prestamo from log_prestamo_det where id_prestamo  = b.id_prestamo),
       (SELECT usuario from cat_usuario where id_usuario  = b.id_usuarioprestamo) as Usuario_Presta,
       a.fh_prestamo,a.id_estatus 
     FROM log_prestamo_cab a,
          log_prestamo_det b,
          cat_cliente c, 
          cat_salon d,
          cat_producto e
     WHERE a.id_prestamo = b.id_prestamo
      AND a.id_cliente = c.id_cliente
      AND a.id_salon = d.id_salon
      AND b.id_producto = e.id_producto;
      
      
      
      SELECT a.id_prestamo
      FROM log_prestamo_cab a,
		   log_prestamo_det b,
           cat_cliente c,
           cat_salon d,
		   cat_producto e,
           cat_usuario f
     WHERE a.id_cliente = c.id_cliente
     AND a.id_salon =d.id_salon
	 AND b.id_producto = e.id_producto
     AND b.id_usuarioprestamo = f.id_usuario
     AND a.id_prestamo = a.id_prestamo 
     ;
     
      ----------------------------------------------------------------
       select *from log_prestamo_cab;


SELECT a.id_prestamo, CONCAT(c.nombre, " ", c.apellidoP, " ", c.apellidoM) as nombre_Completo,
       d.descripcion, e.id_producto, e.descripcionproducto, f.usuario, 
       (SELECT usuario from cat_usuario where id_usuario = b.id_usuarioprestamo) as Usuario_Presta, 
       (SELECT usuario from cat_usuario where id_usuario = b.id_usuariorecibe)  as Usuario_Recibe,
       a.fh_prestamo, a.fh_entrega
      FROM log_prestamo_cab a,
           log_prestamo_det b,
           cat_cliente c,
           cat_salon d,
           cat_producto e,
           cat_usuario f
     WHERE a.id_prestamo = b.id_prestamo
	   AND a.id_cliente = c.id_cliente
	   AND a.id_salon = d.id_salon
       AND b.id_producto = e.id_producto
       AND b.id_usuarioprestamo = f.id_usuario;
       
       SELECT * from log_prestamo_cab 
      inner join log_prestamo_det on log_prestamo_det.id_prestamo=log_prestamo_cab.id_prestamo 
      WHERE log_prestamo_cab.fh_prestamo;
       
      
     update log_prestamo_DET set id_usuarioprestamo = 2
     where id_prestamo_det = 1;
     
     SELECT *FROM cat_producto;
	SELECT *FROM log_prestamo_det;
          
          SELECT *FROM log_prestamo_cab;
          SELECT *FROM cat_usuario;
     UPDATE cat_producto SET cantidad= cantidad + 1 WHERE id_producto = 8;
     UPDATE log_prestamo_det SET id_usuariorecibe = 4  WHERE id_prestamodet = 1 ;
     
     
           SELECT a.id_producto,a.descripcionproducto,a.cantidad,b.descripcionmarca,
  a.modelo, a.serie,a.precio,d.usuario, c.descripciontipo,a.fh_alta,a.fh_baja,a.estatus
  FROM cat_producto a,
       cat_marca b,
       cat_tipo_producto c,
       cat_usuario d
  WHERE  a.id_marca= b.id_marca
   AND a.id_tipo = c.id_tipo
   AND a.id_usuarioalta = d.id_usuario
   AND a.id_producto = id_producto;
   
   
   select *from cat_producto;
   
   
   SELECT a.id_prestamo, CONCAT(c.nombre, " ", c.apellidoP, " ", c.apellidoM) as nombre_Completo,
       d.descripcion, e.descripcionproducto, 
       (SELECT usuario from cat_usuario where id_usuario = b.id_usuarioprestamo) as Usuario_Presta, 
       a.fh_prestamo
      FROM log_prestamo_cab a,
           log_prestamo_det b,
           cat_cliente c,
           cat_salon d,
           cat_producto e
     WHERE a.id_prestamo = b.id_prestamo
	   AND a.id_cliente = c.id_cliente
	   AND a.id_salon = d.id_salon
       AND b.id_producto = e.id_producto;
      
      SELECT *FROM log_prestamo_det;
      SELECT *FROM log_prestamo_cab;
      
      SELECT *FROM detalle_temporal_pres;
      
      

      
      
      SELECT a.id_prestamocab,e.nombre ,d.descripcion ,
      (SELECT descripcionproducto from cat_producto where id_producto  = b.id_producto) as Producto,
      (SELECT usuario from cat_usuario where id_usuario  = b.id_usuarioprestamo) as Usuario_Presta,
      a.fh_prestamo
     FROM log_prestamo_cab a,
		  log_prestamo_det b,
          cat_salon d,
          cat_cliente e
    WHERE a.id_salon = d.id_salon
      AND a.id_cliente=e.id_cliente
	  AND a.id_prestamocab = id_prestamocab ;
      
      
      -------------------------------------

     SELECT d.descripcion,
       (SELECT descripcionproducto from cat_producto where id_producto  = b.id_producto) as Producto,	
       (SELECT id_producto from cat_producto where id_producto  = b.id_producto),
       (SELECT id_prestamo from log_prestamo_det where id_prestamo  = b.id_prestamo),
       (SELECT usuario from cat_usuario where id_usuario  = b.id_usuarioprestamo) as Usuario_Presta,
       a.fh_prestamo,a.id_estatus 
     FROM log_prestamo_cab a,
          log_prestamo_det b,
          cat_cliente c, 
          cat_salon d,
          cat_producto e
     WHERE a.id_prestamo = b.id_prestamo
      AND a.id_cliente = c.id_cliente
      AND a.id_salon = d.id_salon
      AND b.id_producto = e.id_producto;
      
      USE sis_inventario;
      
SELECT * FROM log_prestamo_cab;	
select *from cat_producto;
SELECT *FROM log_prestamo_det;	
UPDATE log_prestamo_cab SET id_estatus = 1 WHERE id_prestamocab = 3;









      
      
       SELECT a.id_prestamocab, CONCAT(c.nombre, ' ', c.apellidoP)as nombre_cliente,
      d.descripcion,
       (SELECT descripcionproducto from cat_producto where id_producto  = b.id_producto) as Producto,	
       (SELECT usuario from cat_usuario where id_usuario  = b.id_usuarioprestamo) as Usuario_Presta,
       a.fh_prestamo,a.id_estatus 
     FROM log_prestamo_cab a,
          log_prestamo_det b,
          cat_cliente c, 
          cat_salon d,
          cat_producto e
     WHERE a.id_prestamocab = b.id_prestamodet 
      AND a.id_cliente = c.id_cliente
      AND a.id_salon = d.id_salon
      AND b.id_producto = e.id_producto;
      
      
      
   SELECT a.id_prestamo, CONCAT(c.nombre, ' ', c.apellidoP)as nombre_cliente,
      d.descripcion,
       (SELECT descripcionproducto from cat_producto where id_producto  = b.id_producto) as Producto,	
       (SELECT usuario from cat_usuario where id_usuario  = b.id_usuarioprestamo) as Usuario_Presta,
       a.fh_prestamo,a.id_estatus 
     FROM log_prestamo_cab a,
          log_prestamo_det b,
          cat_cliente c, 
          cat_salon d,
          cat_producto e
     WHERE a.id_prestamo = b.id_prestamo 
      AND a.id_cliente = c.id_cliente
      AND a.id_salon = d.id_salon
      AND b.id_producto = e.id_producto
      AND a.id_prestamo = b.id_prestamo;
      
      SELECT *FROM cat_producto;
      
   SELECT *FROM log_prestamo_cab;
   SELECT *FROM log_prestamo_det;
   
   SELECT *FROM cat_Salon;
      SELECT *FROM cat_cliente;
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
   SELECT *FROM cat_producto WHERE id_producto = 13
   
   -- consulta
   SELECT DISTINCT a.id_prestamo as clave, CONCAT(c.nombre, ' ', c.apellidoP)as nombre_cliente,
      d.descripcion Salon, e.descripcionproducto as Producto,	e.id_producto,
       (SELECT usuario from cat_usuario where id_usuario  = b.id_usuarioprestamo) as Usuario_Presta,
       a.fh_prestamo,a.id_estatus 
     FROM log_prestamo_cab a,
          log_prestamo_det b,
          cat_cliente c, 
          cat_salon d,
          cat_producto e
	WHERE a.id_prestamo = b.id_prestamo
      AND a.id_cliente = c.id_cliente
      AND a.id_salon = d.id_salon
      AND b.id_producto = e.id_producto;
      
      describe log_prestamo_det;
      SELECT p.id_producto ,p.descripcionproducto, p.precio, d.cantidad, d.id_detalle_temp 
		from cat_producto p join detalle_temporal_pres d ON (p.id_producto = d.id_producto);