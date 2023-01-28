<?php
    class Producto {
        function __construct(int $id_producto, string $nombre, string $descripcion,
            string $marca, string $categoria, float $precio, 
            int $stock, float $peso, string $nombre_imagen) {

                $this->id_producto = $id_producto;
                $this->nombre = $nombre;
                $this->descripcion = $descripcion;
                $this->marca = $marca;
                $this->categoria = $categoria;
                $this->precio = $precio;
                $this->stock = $stock;
                $this->peso = $peso;
                $this->nombre_imagen = $nombre_imagen;
        }
    }
?>