<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        // Crear categorías si no existen
        $categorias = [
            'Guantes' => Categoria::firstOrCreate(
                ['nombre' => 'Guantes'],
                ['descripcion' => 'Guantes de protección para diversos usos industriales']
            ),
            'Máscaras' => Categoria::firstOrCreate(
                ['nombre' => 'Máscaras'],
                ['descripcion' => 'Máscaras de protección respiratoria y facial']
            ),
            'Botas' => Categoria::firstOrCreate(
                ['nombre' => 'Botas'],
                ['descripcion' => 'Botas de seguridad y protección para el trabajo']
            ),
        ];

        // Productos con imágenes fijas de Unsplash
        $productos = [
            'Guantes' => [
                ['nombre' => 'Guantes de Cuero', 'imagen' => 'https://images.unsplash.com/photo-1612198168847-9c8b9b3c84f6'],
                ['nombre' => 'Guantes de Nitrilo', 'imagen' => 'https://images.unsplash.com/photo-1625804341779-1c9a494ed1df'],
                ['nombre' => 'Guantes Industriales', 'imagen' => 'https://images.unsplash.com/photo-1603791440384-56cd371ee9a7'],
                ['nombre' => 'Guantes de Protección', 'imagen' => 'https://images.unsplash.com/photo-1607940635546-21a3a8afc4b8'],
                ['nombre' => 'Guantes Anticorte', 'imagen' => 'https://images.unsplash.com/photo-1611579287350-e010d36ff65a'],
            ],
            'Máscaras' => [
                ['nombre' => 'Máscara Antipolvo', 'imagen' => 'https://images.unsplash.com/photo-1599232374078-5e62cd505b92'],
                ['nombre' => 'Máscara Industrial', 'imagen' => 'https://images.unsplash.com/photo-1605296867304-46d5465a13f1'],
                ['nombre' => 'Máscara de Filtro', 'imagen' => 'https://images.unsplash.com/photo-1583947215259-38b6b3b1b8f3'],
                ['nombre' => 'Máscara de Protección UV', 'imagen' => 'https://images.unsplash.com/photo-1586773860413-87806b176a1a'],
                ['nombre' => 'Máscara Reutilizable', 'imagen' => 'https://images.unsplash.com/photo-1625838071411-2265d25021d3'],
            ],
            'Botas' => [
                ['nombre' => 'Botas de Seguridad', 'imagen' => 'https://images.unsplash.com/photo-1521120118176-3b82fcd57389'],
                ['nombre' => 'Botas Impermeables', 'imagen' => 'https://images.unsplash.com/photo-1534274988745-49b70c44e986'],
                ['nombre' => 'Botas de Trabajo', 'imagen' => 'https://images.unsplash.com/photo-1582553291018-ec8c0df2d973'],
                ['nombre' => 'Botas Antideslizantes', 'imagen' => 'https://images.unsplash.com/photo-1596097077499-146703f54f04'],
                ['nombre' => 'Botas para Construcción', 'imagen' => 'https://images.unsplash.com/photo-1519638831568-d9897f54ed0d'],
            ],
        ];

        // Insertar productos
        $totalProductos = 0;
        foreach ($productos as $categoriaNombre => $items) {
            foreach ($items as $producto) {
                Producto::firstOrCreate(
                    ['nombre' => $producto['nombre']],
                    [
                        'descripcion' => "Descripción de {$producto['nombre']}.",
                        'imagen' => $producto['imagen'],
                        'precio' => rand(20, 120) . '.99',
                        'stock' => rand(10, 40),
                        'categoria_id' => $categorias[$categoriaNombre]->id,
                    ]
                );
                $totalProductos++;
            }
        }

        echo "✅ Se han creado las categorías (Guantes, Máscaras, Botas) y $totalProductos productos con imágenes específicas de Unsplash.\n";
    }
}


