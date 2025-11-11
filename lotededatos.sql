-- ******************************************************
-- SCRIPT DE INSERCIÓN DE DATOS PARA MOTOPARTES Y REPUESTOS
-- ******************************************************

-- 1. INSERCIÓN DE DATOS EN 'categories'
-- Categorías relacionadas con partes de motos.
INSERT INTO categories (name, description) VALUES
('Motor y Transmisión', 'Componentes internos y de fuerza, como pistones, cadenas y piñones.'), -- ID 1
('Electricidad e Iluminación', 'Repuestos relacionados con la batería, luces, bobinas y encendido.'), -- ID 2
('Chasis y Suspensión', 'Partes estructurales, amortiguadores, horquillas y manubrios.'), -- ID 3
('Accesorios y Equipamiento', 'Artículos adicionales para la moto y el motociclista, como cascos y maletas.'), -- ID 4
('Frenos', 'Discos, pastillas, zapatas y sistemas hidráulicos de frenado.'); -- ID 5

-- 2. INSERCIÓN DE DATOS EN 'brands'
-- Marcas comunes de repuestos o accesorios para motos.
INSERT INTO brands (name) VALUES
('PistonPro'),  -- ID 1
('LuzMax'),     -- ID 2
('MotoShock'),  -- ID 3
('RiderGear'),  -- ID 4
('FrenoSeguro'); -- ID 5

-- 3. INSERCIÓN DE DATOS EN 'products'
-- Se asumen los siguientes IDs para las FK:
-- category_id: 1=Motor, 2=Electricidad, 3=Chasis, 4=Accesorios, 5=Frenos
-- brand_id: 1=PistonPro, 2=LuzMax, 3=MotoShock, 4=RiderGear, 5=FrenoSeguro

INSERT INTO products (name, category_id, brand_id, price, stock, photo) VALUES
-- Motor y Transmisión (ID 1, PistonPro ID 1)
('Kit de Cilindro y Pistón 150cc', 1, 1, 85.50, 45, 'url/motopartes/kit_cilindro_150.jpg'),
('Cadena de Transmisión Reforzada 428H', 1, 1, 32.99, 110, 'url/motopartes/cadena_428h.jpg'),
('Filtro de Aceite Sintético', 1, 1, 9.75, 250, 'url/motopartes/filtro_aceite.jpg'),

-- Electricidad e Iluminación (ID 2, LuzMax ID 2)
('Batería de Gel 12V 7AH', 2, 2, 55.00, 70, 'url/motopartes/bateria_gel_7ah.jpg'),
('Faro LED Delantero Universal', 2, 2, 45.90, 90, 'url/motopartes/faro_led.jpg'),

-- Chasis y Suspensión (ID 3, MotoShock ID 3)
('Amortiguadores Traseros Regulables (Par)', 3, 3, 120.00, 30, 'url/motopartes/amortiguadores_par.jpg'),
('Manubrio Deportivo de Aluminio', 3, 3, 28.50, 65, 'url/motopartes/manubrio_aluminio.jpg'),

-- Accesorios y Equipamiento (ID 4, RiderGear ID 4)
('Casco Integral Certificado Talla L', 4, 4, 150.00, 50, 'url/motopartes/casco_integral_l.jpg'),
('Juego de Maletas Laterales Rígidas', 4, 4, 280.00, 20, 'url/motopartes/maletas_rigidas.jpg'),

-- Frenos (ID 5, FrenoSeguro ID 5)
('Pastillas de Freno Sinterizadas (Juego)', 5, 5, 18.25, 180, 'url/motopartes/pastillas_sinterizadas.jpg'),
('Disco de Freno Delantero Flotante', 5, 5, 65.00, 40, 'url/motopartes/disco_flotante.jpg');