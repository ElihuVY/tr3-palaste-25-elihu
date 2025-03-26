<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use App\Models\Producto;

class CategoryAndProductSeeder extends Seeder
{
    public function run()
    {
        // Definir categorías
        $categorias = [
            ['nombre' => 'Guantes', 'descripcion' => 'Guantes de protección para diversos trabajos'],
            ['nombre' => 'Máscaras', 'descripcion' => 'Máscaras de protección respiratoria'],
            ['nombre' => 'Botas', 'descripcion' => 'Botas de seguridad para trabajos industriales'],
            // Agrega más categorías si es necesario
        ];

        // Insertar categorías
        foreach ($categorias as $categoria) {
            $categoriaId = DB::table('categorias')->insertGetId([
                'nombre' => $categoria['nombre'],
                'descripcion' => $categoria['descripcion'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Generar productos para cada categoría
            $this->generarProductos($categoriaId, $categoria['nombre']);
        }
    }

    private function generarProductos($categoriaId, $categoriaNombre)
    {
        $productos = $this->obtenerProductosPorCategoria($categoriaNombre);

        foreach ($productos as $producto) {
            DB::table('productos')->insert([
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'imagen' => $producto['imagen'],
                'precio' => $producto['precio'],
                'stock' => $producto['stock'],
                'categoria_id' => $categoriaId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    private function obtenerProductosPorCategoria($categoriaNombre)
    {
        $productosBase = [
            'Guantes' => [
                [
                    'nombre' => 'Guantes de Cuero',
                    'descripcion' => 'Guantes de cuero resistentes para trabajos de soldadura',
                    'imagen' => 'https://example.com/guantes-cuero.jpg',
                    'precio' => 15.99,
                    'stock' => 100
                ],
                [
                    'nombre' => 'Guantes de Nitrilo',
                    'descripcion' => 'Guantes de nitrilo para protección química',
                    'imagen' => 'https://example.com/guantes-nitrilo.jpg',
                    'precio' => 9.99,
                    'stock' => 200
                ],
                [
                    'nombre' => 'Guantes de Latex',
                    'descripcion' => 'Guantes desechables de látex para trabajos ligeros',
                    'imagen' => 'https://example.com/guantes-latex.jpg',
                    'precio' => 5.99,
                    'stock' => 300
                ],
                [
                    'nombre' => 'Guantes de Algodón',
                    'descripcion' => 'Guantes de algodón suaves para trabajos de precisión',
                    'imagen' => 'https://example.com/guantes-algodon.jpg',
                    'precio' => 3.99,
                    'stock' => 150
                ],
                [
                    'nombre' => 'Guantes de Protección Térmica',
                    'descripcion' => 'Guantes resistentes al calor para trabajos en alta temperatura',
                    'imagen' => 'https://example.com/guantes-termicos.jpg',
                    'precio' => 19.99,
                    'stock' => 80
                ],
            ],
            'Máscaras' => [
                [
                    'nombre' => 'Máscara de Soldador',
                    'descripcion' => 'Máscara de protección para soldadores con filtro',
                    'imagen' => 'https://example.com/mascara-soldador.jpg',
                    'precio' => 45.99,
                    'stock' => 50
                ],
                [
                    'nombre' => 'Máscara de Respiración',
                    'descripcion' => 'Máscara de respiración contra polvo y vapores',
                    'imagen' => 'https://example.com/mascara-respiracion.jpg',
                    'precio' => 29.99,
                    'stock' => 80
                ],
                [
                    'nombre' => 'Máscara Antiviral',
                    'descripcion' => 'Máscara facial con filtro antiviral para protección adicional',
                    'imagen' => 'https://example.com/mascara-antiviral.jpg',
                    'precio' => 25.99,
                    'stock' => 120
                ],
                [
                    'nombre' => 'Máscara de Gas',
                    'descripcion' => 'Máscara de gas para trabajos con sustancias químicas',
                    'imagen' => 'https://example.com/mascara-gas.jpg',
                    'precio' => 79.99,
                    'stock' => 40
                ],
                [
                    'nombre' => 'Máscara con Ventilación',
                    'descripcion' => 'Máscara con ventilación activa para largas jornadas de trabajo',
                    'imagen' => 'https://example.com/mascara-ventilacion.jpg',
                    'precio' => 99.99,
                    'stock' => 30
                ],
            ],
            'Botas' => [
                [
                    'nombre' => 'Botas de Seguridad',
                    'descripcion' => 'Botas resistentes con punta de acero para protección en la construcción',
                    'imagen' => 'https://example.com/botas-seguridad.jpg',
                    'precio' => 59.99,
                    'stock' => 120
                ],
                [
                    'nombre' => 'Botas Impermeables',
                    'descripcion' => 'Botas impermeables para trabajos en condiciones húmedas',
                    'imagen' => 'https://example.com/botas-impermeables.jpg',
                    'precio' => 49.99,
                    'stock' => 150
                ],
                [
                    'nombre' => 'Botas de Goma',
                    'descripcion' => 'Botas de goma resistentes para trabajos en terrenos mojados',
                    'imagen' => 'https://example.com/botas-goma.jpg',
                    'precio' => 39.99,
                    'stock' => 100
                ],
                [
                    'nombre' => 'Botas de Cuero',
                    'descripcion' => 'Botas de cuero resistentes con protección en el tobillo',
                    'imagen' => 'https://example.com/botas-cuero.jpg',
                    'precio' => 89.99,
                    'stock' => 60
                ],
                [
                    'nombre' => 'Botas de Protección Eléctrica',
                    'descripcion' => 'Botas de seguridad con aislamiento eléctrico para protección en ambientes peligrosos',
                    'imagen' => 'https://example.com/botas-electricas.jpg',
                    'precio' => 99.99,
                    'stock' => 40
                ],
            ],
        ];

        // Si la categoría no existe, devuelve un array vacío
        return $productosBase[$categoriaNombre] ?? [];
    }
}
