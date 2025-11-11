-- Configuración para asegurar que las claves foráneas funcionen correctamente
SET FOREIGN_KEY_CHECKS = 0;

-- 1. DROP TABLES (para limpiar y permitir recreación)
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS brands;
 -- 1. DROP TABLES (para limpiar antes de crear)
DROP TABLE IF EXISTS sales_details;
DROP TABLE IF EXISTS sales;

-- 2. Creación de la tabla 'categories'
CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- 3. Creación de la tabla 'brands'
-- Si la parte anterior daba error, esta sintaxis es la estándar de MySQL.
CREATE TABLE brands (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- 4. Creación de la tabla 'users' (campo 'avatar' añadido)
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client', 'guest') NOT NULL DEFAULT 'client',
    email VARCHAR(255) NOT NULL UNIQUE,
    avatar VARCHAR(255), -- Nuevo campo para la ruta o URL del avatar
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- 5. Creación de la tabla 'products' (con claves foráneas)
CREATE TABLE products (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    brand_id INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    photo VARCHAR(255),

    PRIMARY KEY (id),

    -- Clave Foránea a la tabla 'categories'
    FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    -- Clave Foránea a la tabla 'brands'
    FOREIGN KEY (brand_id) REFERENCES brands(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=INNODB;


-- 2. Creación de la tabla 'sales' (Ventas)
-- Contiene la información principal de la transacción.
CREATE TABLE sales (
    id INT NOT NULL AUTO_INCREMENT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
	 user_id INT NOT NULL,        
    PRIMARY KEY (id)
) ENGINE=InnoDB;


-- 3. Creación de la tabla 'sales_details' (Detalles de Venta o Líneas de Pedido)
-- Contiene el desglose de cada producto vendido.
CREATE TABLE sales_details (
    id INT NOT NULL AUTO_INCREMENT,
    id_sale INT NOT NULL,
    id_product INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,

    PRIMARY KEY (id),

    -- Clave Foránea a la tabla 'sales' (Relación 1:N)
    FOREIGN KEY (id_sale) REFERENCES sales(id)
        ON DELETE CASCADE     -- Si se elimina la venta, se eliminan sus detalles
        ON UPDATE CASCADE,

    -- Clave Foránea a la tabla 'products' (El producto que se vendió)
    FOREIGN KEY (id_product) REFERENCES products(id)
        ON DELETE RESTRICT    -- No se permite borrar un producto si está en un historial de ventas
        ON UPDATE CASCADE
) ENGINE=InnoDB;
-- Volver a habilitar la verificación de claves foráneas
SET FOREIGN_KEY_CHECKS = 1;
