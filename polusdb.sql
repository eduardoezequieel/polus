CREATE TABLE estadoUsuario(
	idEstadoUsuario serial not null primary key,
	estadoUsuario character varying(10) not null
);

CREATE TABLE estadoPedido(
	idEstadoPedido serial not null primary key,
	estadoPedido character varying(20) not null 
);

CREATE TABLE tipoUsuario(
	idTipoUsuario serial not null primary key,
	tipoUsuario character varying(20) not null 
);

CREATE TABLE puntuacion(
	idPuntuacion serial not null primary key,
	puntuacion character varying(10) not null 
);

CREATE TABLE categoria(
	idCategoria serial not null primary key,
	categoria character varying(30) not null 
);

CREATE TABLE marca(
	idMarca serial not null primary key,
	marca character varying(25) not null 
);

CREATE TABLE talla(
	idTalla serial not null primary key,
	talla character varying(15) not null,
	genero character varying(10) not null
);

CREATE TABLE admon(
	idAdmon serial not null primary key,
	nombre character varying(25) not null,
	apellido character varying(25) not null,
	genero character varying(10) not null,
	correo character varying(80) not null,
	foto bytea not null,
	fechaNacimiento date not null,
	telefono char(9) not null,
	direccion character varying(200) not null,
	usuario character varying(25) not null,
	contraseña character varying(40) not null,
    idEstadoUsuario integer REFERENCES estadoUsuario(idEstadoUsuario),
	idTipoUsuario integer REFERENCES tipoUsuario(idTipoUsuario)
);

CREATE TABLE cliente(
	idCliente serial not null primary key,
	nombre character varying(25) not null,
	apellido character varying(25) not null,
	genero character varying(10) not null,
	correo character varying(80) not null,
	foto bytea not null,
	fechaNacimiento date not null,
	telefono char(9) not null,
	direccion character varying(200) not null,
	usuario character varying(25) not null,
	contraseña character varying(40) not null,
    idEstadoUsuario integer REFERENCES estadoUsuario(idEstadoUsuario)
);

CREATE TABLE pedido(
	idPedido serial not null primary key,
	fechaPedido date not null,
	idEstadoPedido integer REFERENCES estadoPedido(idEstadoPedido),
	idCliente integer REFERENCES cliente(idCliente)
);

CREATE TABLE subcategoria(
	idSubcategoria serial not null primary key,
	subcategoria character varying(30) not null,
	genero character varying(10) not null,
	idCategoria integer REFERENCES categoria(idCategoria)
);

CREATE TABLE producto(
	idProducto serial not null primary key,
	nombre character varying(30) not null,
	descripcion character varying(120) not null,
	precio numeric not null,
	imagenPrincipal bytea not null,
	idSubcategoria integer REFERENCES subcategoria(idSubcategoria),
	idMarca integer REFERENCES marca(idMarca)
);

CREATE TABLE detallePedido(
	idDetallePedido serial not null primary key,
	cantidad integer not null,
	precioProducto numeric not null,
	idPedido integer REFERENCES pedido(idPedido),
	idProducto integer REFERENCES producto(idProducto)
);

CREATE TABLE resena(
	idResena serial not null primary key,
	comentario character varying(80) not null,
	idPuntuacion integer REFERENCES puntuacion(idPuntuacion),
	idDetallePedido integer REFERENCES detallePedido(idDetallePedido)
);

CREATE TABLE imagenProducto(
	idImagenProducto serial not null primary key,
	imagen bytea not null,
	idProducto integer REFERENCES producto(idProducto)
);

CREATE TABLE inventario(
	idInventario serial not null primary key,
	cantidad integer not null,
	idProducto integer REFERENCES producto(idProducto),
	idTalla integer REFERENCES talla(idTalla)
);

CREATE TABLE bitacora(
	idBitacora serial not null primary key,
	fecha_hora timestamp not null,
	descripcion character varying(200) not null,
	idAdmon integer REFERENCES admon(idAdmon)
);

CREATE TABLE precioAntiguo(
	idPrecioAntiguo SERIAL NOT NULL PRIMARY KEY,
	idProducto INTEGER REFERENCES producto(idProducto),
	precio NUMERIC NOT NULL,
	fecha_hora TIMESTAMP NOT NULL
);

INSERT INTO estadoUsuario(estadoUsuario) VALUES('Activo'),('Inactivo'),('Bloqueado');
INSERT INTO estadoPedido(estadoPedido) VALUES('Activo'),('Completado'),('Suspendido');
INSERT INTO tipoUsuario(tipoUsuario) VALUES('Administrador'),('Empleado'),('Repartidor');
INSERT INTO puntuacion(puntuacion) VALUES('1'),('2'),('3'),('4'),('5');
INSERT INTO categoria(categoria) VALUES('Ropa'),('Cuidado Facial'),('Maquillaje');
INSERT INTO marca(marca) VALUES('Adidas'),('Only'),('Lola Makeup');
INSERT INTO marca(marca) VALUES('Nike'),('Closet');
INSERT INTO talla(talla, genero) VALUES('XS','Dama'),('XS','Caballero'),
										('S','Dama'),('S','Caballero'),
										('M','Dama'),('M','Caballero'),
										('L','Dama'),('L','Caballero'),
										('XL','Dama'),('XL','Caballero');
INSERT INTO admon(nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, idEstadoUsuario, idTipoUsuario ) 
		VALUES('Katherine Andrea','González Salinas','Femenino','katy06salinas@gmail.com','xDEADBEEF','2002-12-03','7143-4109','Panchimalco, San Salvador','Kath34','katy312',1,1),
			  ('Eduardo Ezequiel','López Rivera','Masculino','eduardxlr@gmail.com','xDEADBEEF','2002-04-17','7146-6342','Mejicanos, San Salvador','Eduardxlr','eduardxrl04',1,1),
			  ('Samuel Eduardo','Magaña Hernández','Masculino','magaña24@gmail.com','xDEADBEEF','2003-02-24','6143-1054','San Salvador, San Salvador','Magaña12','1234mag',1,2),
			  ('Paola Rebeca','Morales García','Femenino','pao_garcia@gmail.com','xDEADBEEF','2000-10-15','7186-4803','San Marcos, San Salvador','Pao','pao56',1,2),
			  ('Dennis Alexander','Caballero Castillo','Masculino','caballero@gmail.com','xDEADBEEF','2001-06-01','7341-6494','San Salvador, San Salvador','Cabelleroc','caba1203',1,3);
			  
INSERT INTO cliente(nombre, apellido, genero, correo, foto, fechaNacimiento, telefono, direccion, usuario, contraseña, idEstadoUsuario) 
		VALUES('Javier Antonio','Oliveira Durán','Masculino','javioliveira@gmail.com','xDEADBEEF','1996-03-21','6197-5236','Soyapango, San Salvador','javiO','oliveira3',1),
			  ('María Jóse','Reyes Campos','Femenino','majoreyes@gmail.com','xDEADBEEF','1998-01-30','7589-4103','San Salvador, San Salvador','Majo','majo34',1),
			  ('Rosa Guadalupe','Benitez Lorenzo','Femenino','rosalorenzo@gmail.com','xDEADBEEF','1995-05-25','7542-7363','San Salvador, San Salvador','rosa','roslorenzo',1),
			  ('Olivia Luna','Gimenez Flores','Femenino','luna31@gmail.com','xDEADBEEF','1997-12-31','6333-6393','San Marcos, San Salvador','Luna31','luna456',1),
			  ('Mateo Arturo','Santos Martinez','Masculino','matero@gmail.com','xDEADBEEF','2000-09-12','6412-0312','San Salvador, San Salvador','Mateo','mateo09',1) ;
			  
INSERT INTO pedido(fechaPedido, idEstadoPedido, idCliente) VALUES ('2021-03-21',1,3),
																  ('2021-03-20',1,1),
																  ('2021-03-15',3,4),
																  ('2021-03-10',2,2),
																  ('2021-02-28',2,5);

INSERT INTO subcategoria(subcategoria, genero, idCategoria) VALUES	('Short', 'Caballero',1),
																	('Sombra', 'Dama',3),
																	('Mascarilla', 'Unisex',2),
																	('Jeans', 'Caballero',1),
																	('Labial', 'Dama',3);

INSERT INTO producto(nombre, descripcion, precio, imagenPrincipal, idSubcategoria, idMarca) VALUES('Innova', 'Pack de sombras',15.50,'xDEADBEEF',2,3),
																								  ('Stretch', 'Short color azul para caballeros',8.50,'xDEADBEEF',1,1),
																								  ('Sweet Kisses', 'Labial rojo sweet kisses',5.25,'xDEADBEEF',5,3),
																								  ('Care', 'Mascarilla de aguacate unisex para el cuidado de la piel',3.75,'xDEADBEEF',3,2),
																								  ('Skinny', 'Jeans color negro modelo Skinny para caballeros',10.00,'xDEADBEEF',4,2);
																									
INSERT INTO imagenProducto(imagen, idProducto) VALUES('xDEADBEEF',1),('xDEADBEEF',1),('xDEADBEEF',1),
											 ('xDEADBEEF',2),('xDEADBEEF',2),('xDEADBEEF',2),
											 ('xDEADBEEF',3),('xDEADBEEF',3),('xDEADBEEF',3),
											 ('xDEADBEEF',4),('xDEADBEEF',4),('xDEADBEEF',4),
											 ('xDEADBEEF',5),('xDEADBEEF',5),('xDEADBEEF',5);
											 
--Las tablas detalle son: 
--detallePedido
--Reseña
--Inventario

INSERT INTO detallePedido(cantidad,precioProducto,idPedido,idProducto) VALUES(15,15.50,1,4);
INSERT INTO detallePedido(cantidad,precioProducto,idPedido,idProducto) VALUES(1,12.99,1,1);
INSERT INTO detallePedido(cantidad,precioProducto,idPedido,idProducto) VALUES(7,8.99,2,4),
																			 (9,18.00,3,4),
																			 (2,20.00,4,5),
																			 (1,15.50,5,1),
																			 (3,15.75,1,3),
																			 (5,18.75,2,4),
																			 (1,8.50,3,2),
																			 (1,15.50,4,1),
																			 (1,3.75,5,4),
																			 (2,7.50,1,4),
																			 (3,15.00,2,4),
																			 (3,15.00,3,4),
																			 (1,3.75,4,4),
																			 (1,3.75,5,4),
																			 (5,18.75,1,4),
																			 (4,34.00,4,2),
																			 (2,10.50,5,3),
																			 (1,3.75,3,4),
																			 (1,15.50,3,1),
																			 (1,8.50,1,2),
																			 (2,10.50,1,3),
																			 (1,3.75,2,4),
																			 (1,15.50,3,1),
																			 (3,25.50,2,2),
																			 (2,10.50,2,3),
																			 (1,3.75,2,4),
																			 (1,15.50,3,1),
																			 (1,8.50,4,2);
																		
insert into resena(comentario,idpuntuacion,iddetallepedido) values ('Muy buenos productos',5,1);
insert into resena(comentario,idpuntuacion,iddetallepedido) values ('Me encantan sus productos',5,2),
																   ('Buena calidad',4,3),
																   ('Me gustaron mucho',5,4),
																   ('Me gusta',5,5),
																   ('Excelente servicio',5,6),
																   ('Muy buen servicio',5,7),
																   ('Muy buenos productos',5,8),
																   ('Excelente servicio',5,9),
																   ('Me gustaron mucho productos',5,10),
																   ('Buen servicio',4,11),
																   ('Todo muy bien',4,12),
																   ('Muy buenos productos',5,13),
																   ('Servicio impecable',5,14),
																   ('Muy buenos productos',5,15),
																   ('Me encantaron los productos',5,16),
																   ('Excelente servicio',5,17),
																   ('Excelente servicio',5,18),
																   ('Muy buenos productos',5,19),
																   ('Buena calidad en los productos',5,20),
																   ('Excelente calidad',5,21),
																   ('Excelente calidad en los productos',5,22),
																   ('Productos muy buenos',5,23),
																   ('Productos de muy buena calidad',5,24),
																   ('Calidad en el servivio',5,25),
																   ('Muy buenos productos',5,26),
																   ('Calidad en el producto',5,27),
																   ('Muy buenos productos',5,28),
																   ('Buenos productos',4,29),
																   ('Muy buenos productos',5,30);
																   
insert into inventario (cantidad,idproducto,idtalla) values (12,2,3);
insert into inventario (cantidad,idproducto,idtalla) values (15,5,4),
															(5,2,5),
															(7,2,6),
															(9,2,4),
															(20,5,4),
															(15,5,3),
															(30,2,5),
															(12,5,6),
															(19,2,7),
															(17,2,5),
															(13,5,4),
															(18,5,5),
															(20,2,6),
															(16,2,4),
															(11,5,5),
															(15,2,6),
															(18,5,7),
															(19,2,4),
															(21,2,5),
															(27,5,7),
															(15,2,9),
															(23,5,10),
															(22,2,4),
															(12,5,3),
															(22,2,2),
															(26,2,1),
															(29,5,3),
															(32,5,6),
															(31,2,5);
--Cambios 14/5/2021
CREATE TABLE estadoMarca(
	idEstadoMarca SERIAL NOT NULL PRIMARY KEY,
	estadoMarca VARCHAR(20) NOT NULL
);

INSERT INTO estadoMarca(estadoMarca) VALUES ('Disponible'),('No disponible');
ALTER TABLE marca ADD COLUMN idEstadoMarca INTEGER NULL REFERENCES estadoMarca(idEstadoMarca);
UPDATE marca SET idEstadoMarca = 1;

--Cambios (Hechos por Katherine)
ALTER TABLE admon ALTER COLUMN foto TYPE character varying(50) USING CAST(foto AS bytea);
ALTER TABLE admon ALTER COLUMN contraseña TYPE character varying(60) USING CAST(contraseña AS character varying);

ALTER TABLE cliente ALTER COLUMN foto TYPE character varying(50) USING CAST(foto AS bytea);
ALTER TABLE cliente ALTER COLUMN contraseña TYPE character varying(60) USING CAST(contraseña AS character varying);

ALTER TABLE producto ALTER COLUMN imagenPrincipal TYPE character varying(50) USING CAST(imagenPrincipal AS bytea);

--Cambios 15/5/2021
UPDATE estadoPedido SET estadopedido = 'Cancelado' WHERE idestadopedido = 3;
INSERT INTO estadoPedido(estadopedido) VALUES ('En proceso');

--Cambios 16/5/2021
ALTER TABLE resena ADD COLUMN respuesta VARCHAR(200) NULL;
ALTER TABLE puntuacion ALTER COLUMN puntuacion TYPE VARCHAR(15);
UPDATE puntuacion SET puntuacion = '1 estrella' WHERE idpuntuacion = 1;
UPDATE puntuacion SET puntuacion = '2 estrellas' WHERE idpuntuacion = 2;
UPDATE puntuacion SET puntuacion = '3 estrellas' WHERE idpuntuacion = 3;
UPDATE puntuacion SET puntuacion = '4 estrellas' WHERE idpuntuacion = 4;
UPDATE puntuacion SET puntuacion = '5 estrellas' WHERE idpuntuacion = 5;

--Cambios 1/6/2021
ALTER TABLE resena DROP COLUMN iddetallepedido;
ALTER TABLE resena ADD COLUMN idproducto INTEGER REFERENCES producto(idProducto);
UPDATE resena SET idproducto = 1;

ALTER TABLE resena ADD COLUMN idcliente INTEGER REFERENCES cliente(idcliente);
UPDATE resena SET idcliente = 1;

ALTER TABLE resena ADD COLUMN fecha DATE;
ALTER TABLE resena ADD COLUMN hora TIME;

UPDATE resena SET fecha = current_date;
UPDATE resena SET hora = current_time;

--cambios 05/06/2021
alter table cliente add constraint UQ_cliente_correo unique (correo);
alter table admon add constraint UQ_admon_correo unique (correo);
alter table cliente add constraint UQ_cliente_usuario unique (usuario);
alter table admon add constraint UQ_admon_usuario unique (usuario);

--Cambios 5/6/2021
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 1;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 2;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 3;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 4;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 5;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 6;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 7;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 8;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 9;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 10;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 11;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 12;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 13;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 14;
UPDATE resena SET fecha = '2021-06-02' WHERE idresena = 15;

UPDATE resena SET idproducto = 2 WHERE idresena = 1;
UPDATE resena SET idproducto = 2 WHERE idresena = 2;
UPDATE resena SET idproducto = 2 WHERE idresena = 3;
UPDATE resena SET idproducto = 2 WHERE idresena = 4;
UPDATE resena SET idproducto = 2 WHERE idresena = 5;

--Cambios 6/6/2021
ALTER TABLE categoria ADD COLUMN imagen VARCHAR(50) NULL;
ALTER TABLE imagenProducto ALTER COLUMN imagen TYPE character varying(50) USING CAST(imagen AS bytea);

--Cambios 20/07/2021
INSERT INTO talla VALUES(DEFAULT, 'N/A','N/A');


--Trigger para guardar precios de un producto durante el tiempo
CREATE TABLE historialPrecio(
	idHistorialPrecio SERIAL NOT NULL PRIMARY KEY,
	idProducto INTEGER NOT NULL, 
	precio NUMERIC NOT NULL,
	fecha DATE NOT NULL
);

CREATE FUNCTION SP_historialPrecio() RETURNS TRIGGER 
AS
$$
BEGIN
INSERT INTO historialPrecio(idProducto, precio, fecha) VALUES(old.idProducto, old.precio, current_date);
RETURN NEW;
END
$$
LANGUAGE plpgsql;

CREATE TRIGGER TR_historialPrecio BEFORE UPDATE ON producto 
FOR EACH ROW
EXECUTE PROCEDURE SP_historialPrecio();

--Cambios 24/07/2021
ALTER TABLE resena ALTER COLUMN comentario TYPE CHARACTER VARYING(80) USING CAST(comentario AS CHARACTER VARYING(200));

--Tabla faltante
CREATE TABLE estadoResena(
	idEstadoResena SERIAL NOT NULL PRIMARY KEY,
	estadoResena VARCHAR(20) NOT NULL
);

ALTER TABLE resena ADD COLUMN idestadoresena INTEGER NOT NULL REFERENCES estadoResena(idestadoresena);

INSERT INTO estadoResena(estadoResena) VALUES('Visible'),('Oculto');

--Cambios 26/7/2021
CREATE TABLE historialInventario(
	idHistorialInventario SERIAL NOT NULL PRIMARY KEY,
	idInventario INTEGER NOT NULL REFERENCES inventario(idInventario),
	cantidad NUMERIC NOT NULL, 
	fecha DATE NOT NULL
);

CREATE FUNCTION SP_historialInventario() RETURNS TRIGGER 
AS
$$
BEGIN
INSERT INTO historialInventario(idInventario, cantidad, fecha) VALUES(old.idInventario, old.cantidad, current_date);
RETURN NEW;
END
$$
LANGUAGE plpgsql;

CREATE TRIGGER TR_historialInventario BEFORE UPDATE ON inventario 
FOR EACH ROW
EXECUTE PROCEDURE SP_historialInventario();

ALTER TABLE cliente ADD COLUMN fechaRegistro DATE;
UPDATE cliente SET fechaRegistro = current_date;

UPDATE cliente SET fechaRegistro = '2021-03-04' WHERE idcliente = 1;
UPDATE cliente SET fechaRegistro = '2021-04-04' WHERE idcliente = 2;
UPDATE cliente SET fechaRegistro = '2021-05-04' WHERE idcliente = 3;
UPDATE cliente SET fechaRegistro = '2021-06-04' WHERE idcliente = 4;
UPDATE cliente SET fechaRegistro = '2021-07-04' WHERE idcliente = 5;

--CAMBIOS IMPORTANTES
CREATE TABLE historialSesionAdmon(
	idhistorialsesion_a SERIAL NOT NULL PRIMARY KEY,
	idAdmon INTEGER NOT NULL REFERENCES admon(idadmon),
	phpinfo VARCHAR(500) NOT NULL,
	fechasesion DATE NOT NULL
);

CREATE TABLE historialSesionCliente(
	idhistorialsesion_c SERIAL NOT NULL PRIMARY KEY,
	idCliente INTEGER NOT NULL REFERENCES cliente(idcliente),
	phpinfo VARCHAR(500) NOT NULL,
	fechasesion DATE NOT NULL
);

--Cambios 10/09/2021
DROP TABLE bitacora;

CREATE TABLE bitacoraUsuario(
	idBitacora serial not null primary key,
	idAdmon integer REFERENCES admon(idAdmon),
	fecha date not null,
	hora time not null,
	accion character varying(20) not null, 
	descripcion character varying(200) not null
);

CREATE TABLE bitacoraCliente(
	idBitacora serial not null primary key,
	idCliente integer REFERENCES cliente(idCliente),
	fecha date not null,
	hora time not null,
	accion character varying(20) not null, 
	descripcion character varying(200) not null
);

--Cambios 11/09/2021
ALTER TABLE admon ADD COLUMN dobleautenticacion CHAR(2) NULL
UPDATE admon SET dobleautenticacion = 'No'
ALTER TABLE admon ALTER COLUMN dobleautenticacion SET NOT NULL

--Cambios 12/09/2021
ALTER TABLE admon ADD COLUMN intentos INT;
UPDATE admon SET intentos = 0;
ALTER TABLE admon ALTER COLUMN intentos SET NOT NULL;
ALTER TABLE admon ADD COLUMN tokenClave CHARACTER VARYING(60); 
ALTER TABLE admon ADD COLUMN claveRequest INT; 
UPDATE admon SET claveRequest = 0;
ALTER TABLE admon ALTER COLUMN claveRequest SET NOT NULL;