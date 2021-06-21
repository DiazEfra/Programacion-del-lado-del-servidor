CREATE DATABASE artesanias CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE artesanias;

GRANT ALL ON artesanias.* TO artesano@'localhost' IDENTIFIED BY '3l4rt3s4n0';
GRANT ALL ON artesanias.* TO artesano@'%' IDENTIFIED BY '3l4rt3s4n0';

CREATE TABLE clasificacion 
( id BIGINT AUTO_INCREMENT
, descripcion VARCHAR (50)
, padre BIGINT DEFAULT 0
, CONSTRAINT pkClasifica PRIMARY KEY(id)
);

CREATE TABLE especialidades
( id BIGINT AUTO_INCREMENT
, descripcion VARCHAR(50) NOT NULL
, CONSTRAINT pkespecialidad PRIMARY KEY (id)
);

CREATE TABLE artesanos 
( id BIGINT AUTO_INCREMENT
, nombres VARCHAR(100) NOT NULL
, primerapellido VARCHAR (50) NOT NULL
, segundoapellido VARCHAR (50)
, domicilio VARCHAR (100)
, telefono VARCHAR (20)
, correo VARCHAR (100) UNIQUE
, CONSTRAINT pkartesano PRIMARY KEY (id)
);

CREATE TABLE artesanoespecialidad 
(  artesano_id BIGINT
,  especialidad_id BIGINT
, CONSTRAINT pkartesanoespecialidad PRIMARY KEY (artesano_id, especialidad_id)
);



CREATE TABLE productos
( id BIGINT AUTO_INCREMENT
, producto VARCHAR (100) NOT NULL
, descripcion TEXT
, clasificacion_id BIGINT
, artesano_id BIGINT
, precio DOUBLE 
, existencias INT DEFAULT 0
, CONSTRAINT pkproductos PRIMARY KEY (id)
, CONSTRAINT fkClasificaProducto FOREIGN KEY (clasificacion_id) 
  REFERENCES clasificacion (id)
, CONSTRAINT fkArtesanoProducto FOREIGN KEY (artesano_id)
  REFERENCES artesanos (id)
); 

CREATE TABLE productoimagen 
( id  BIGINT AUTO_INCREMENT
, producto_id BIGINT
, imagen VARCHAR (100) NOT NULL
, CONSTRAINT pkproductoimagen PRIMARY KEY (id)
);

CREATE TABLE clientes 
( id BIGINT AUTO_INCREMENT 
, nombreorazonsocial VARCHAR (100) NOT NULL
, domicilio VARCHAR (100)
, telefono VARCHAR (20)
, correo VARCHAR (100)
, contacto VARCHAR (100)
, CONSTRAINT pkClientes PRIMARY KEY (id)
); 

CREATE TABLE pedidos 
( id BIGINT AUTO_INCREMENT
, fecha DATETIME  NOT NULL 
, cliente_id BIGINT 
, formapago VARCHAR (50)
, domicilioentrega VARCHAR (100) 
, CONSTRAINT pkPedidos PRIMARY KEY (id)
, CONSTRAINT fkClientePedido FOREIGN KEY (cliente_id)
  REFERENCES clientes (id)
);

CREATE TABLE detallepedidos 
( id BIGINT  AUTO_INCREMENT
, producto_id BIGINT
, pedido_id BIGINT
, cantidad INT 
, precioventa DOUBLE 
, observaciones TEXT 
, CONSTRAINT pkDP PRIMARY KEY (id)
, CONSTRAINT fkProductoDP FOREIGN KEY (producto_id) 
  REFERENCES productos (id)
, CONSTRAINT fkPedidoDP FOREIGN KEY (pedido_id)  
  REFERENCES pedidos (id)
);

CREATE TABLE usuarios
( id BIGINT AUTO_INCREMENT
, nombrecompleto VARCHAR (100) NOT NULL
, cuenta VARCHAR (20) UNIQUE
, password VARCHAR (128)
, vigente TINYINT
, CONSTRAINT pkUsr PRIMARY KEY (id)
);

CREATE TABLE roles 
( id BIGINT AUTO_INCREMENT
, descripcion VARCHAR(50)
, CONSTRAINT pkroles PRIMARY KEY (id)
);

CREATE TABLE usuariorol
( usuario_id BIGINT
, rol_id BIGINT
, CONSTRAINT pkUsrRol PRIMARY KEY (usuario_id, rol_id)
);

CREATE TABLE facturas
( pedido_id BIGINT
, fechafacturacion DATETIME
, iva DOUBLE DEFAULT 16.0
, CONSTRAINT pkFactura PRIMARY KEY (pedido_id)
); 

CREATE TABLE devoluciones
( id BIGINT AUTO_INCREMENT
, fechadevolucion DATETIME
, producto_id BIGINT
, pedido_id BIGINT
, cantidad INT 
, estado VARCHAR (100)
, importe DOUBLE
, observaciones TEXT 
, CONSTRAINT pkdevoluciones PRIMARY KEY (id)
, CONSTRAINT fkPedidoDevolucion FOREIGN KEY (pedido_id) 
  REFERENCES pedidos(id)
, CONSTRAINT fkProductoDevolucion FOREIGN KEY (producto_id)  
  REFERENCES productos (id)
);


INSERT INTO clasificacion (descripcion)
VALUES 
('Barros'), ('Alebrijes'), ('Ropas'), ('Bebidas');
