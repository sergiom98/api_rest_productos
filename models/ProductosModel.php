<?php
    class ProductosModel {

        function __construct() {
            $this->db = ConexionDB::conectar();
        }

        function getProductos() {
            try {
                $productos = [];
                $sql = "SELECT * FROM productos";
                $result = $this->db->query($sql);
                foreach ($result as $value) {
                    $productos[] = $this->convertFromAssoc($value);
                }
                return $productos;
            } catch (PDOException $e) {
                echo "Error. " . $e->getMessage();
                exit("Error. " . $e->getMessage());
            }
        }

        function getProducto($id) {
            try {
                $sql = "SELECT * FROM productos WHERE id_producto = $id";
                $result = $this->db->query($sql);
                $producto = $result->fetchAll();
                if (count($producto) > 0) {
                    return $this->convertFromAssoc($producto[0]);
                } else {
                    return false;
                }

            } catch (PDOException $e) {
                echo "Error. " . $e->getMessage();
                exit("Error. " . $e->getMessage());
            }
        }

        function updateProducto($producto) {
            $ok = false;
            try {
                $sql = "UPDATE productos 
                    SET nombre = '$producto->nombre',
                        descripcion = '$producto->descripcion',
                        marca = '$producto->marca',
                        stock = $producto->stock,
                        peso = $producto->peso,
                        categoria = '$producto->categoria',
                        imagen = '$producto->nombre_imagen',
                        precio = $producto->precio
                        WHERE id_producto = $producto->id_producto";
                $resultado = $this->db->exec($sql);
                if ($resultado) {
                    $ok = true;
                } else {
                    $ok = false;
                }
        
            } catch (PDOException $e) {
                $ok = false;
            }
            return $ok;
        }
    
        function createProducto($producto) {
            $ok = false;
            try {
                $sql = "INSERT INTO productos (nombre, descripcion, marca, 
                stock, peso, categoria, precio, imagen) 
                VALUES (
                    '$producto->nombre',
                    '$producto->descripcion',
                    '$producto->marca',
                    $producto->stock,
                    $producto->peso,
                    '$producto->categoria',
                    $producto->precio,
                    '$producto->nombre_imagen')";
                // var_dump($sql);
                $resultado = $this->db->exec($sql);
                if ($resultado) {
                    $ok = true;
                } else {
                    $ok = false;
                }
        
            } catch (PDOException $e)  {
                $ok = false;
            }
            return $ok;
        }
    
        function deleteProducto($id) {
            try {
                $sql = 'DELETE FROM productos WHERE id_producto=' . $id;
                $resultado = $this->db->exec($sql);
                return $resultado;
            } catch(Exception $e) {
                return false;
                //throw new Exception("No se ha podido conectar con la base de datos", 1);
            }
            return false;
        }

        private function convertFromAssoc($producto) {
            return new Producto(
                $producto['id_producto'],
                $producto['nombre'],
                $producto['descripcion'],
                $producto['marca'],
                $producto['categoria'],
                $producto['precio'],
                $producto['stock'],
                $producto['peso'],
                $producto['imagen'],
            );
        }
    }