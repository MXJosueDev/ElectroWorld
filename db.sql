CREATE TABLE proveedor (
    id_proveedor INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    direccion VARCHAR(250) NOT NULL,
    telefono VARCHAR(15) NOT NULL
);

CREATE TABLE producto (
    id_producto INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(250) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL,
    image_data LONGTEXT NOT NULL,
    id_proveedor INT NOT NULL,
    FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor)
);

CREATE TABLE tienda (
    id_tienda INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    direccion VARCHAR(250) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    nombre VARCHAR(150)
);

CREATE TABLE tienda_producto (
    id_tienda INT NOT NULL,
    id_producto INT NOT NULL,
    FOREIGN KEY (id_tienda) REFERENCES tienda(id_tienda),
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);