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
	contrasena character varying(40) not null,
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

--Cambios 14/5/2021
CREATE TABLE estadoMarca(
	idEstadoMarca SERIAL NOT NULL PRIMARY KEY,
	estadoMarca VARCHAR(20) NOT NULL
);

INSERT INTO estadoMarca(estadoMarca) VALUES ('Disponible'),('No disponible');
ALTER TABLE marca ADD COLUMN idEstadoMarca INTEGER NULL REFERENCES estadoMarca(idEstadoMarca);
UPDATE marca SET idEstadoMarca = 1

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

