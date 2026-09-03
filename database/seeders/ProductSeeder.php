<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Importamos el modelo

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Producto 1
        Product::create([
            'name' => 'Camisa Blanca Hombre',
            'price' => 1290,
            'category' => 'Remeras y Camisas',
            'gender' => 'Hombre',
            'stock' => 20,
            'description' => 'Camisa de vestir blanca, corte entallado. Ideal para eventos formales o el trabajo.',
            'sizes' => ['S', 'M', 'L', 'XL'], // Gracias al "cast" que hicimos, pasamos un array de PHP y Laravel lo guarda como JSON.
            'image_path' => 'rutas-imagenes/camisa-blanca.jpg' // Por ahora ponemos un texto de ejemplo
        ]);

        // Producto 2
        Product::create([
            'name' => 'Remera Algodón Hombre',
            'price' => 590,
            'category' => 'Remeras y Camisas',
            'gender' => 'Hombre',
            'stock' => 45,
            'description' => 'Remera lisa de algodón, muy cómoda. Perfecta para el día a día.',
            'sizes' => ['S', 'M', 'L'],
            'image_path' => 'rutas-imagenes/remera-algodon.jpg'
        ]);

        // Producto 3
        Product::create([
            'name' => 'Campera Invierno Hombre',
            'price' => 2890,
            'category' => 'Camperas',
            'gender' => 'Hombre',
            'stock' => 15,
            'description' => 'Campera acolchada de abrigo, resistente al viento.',
            'sizes' => ['M', 'L', 'XL'],
            'image_path' => 'rutas-imagenes/campera-invierno.jpg'
        ]);

        // Producto 4
        Product::create([
            'name' => 'Remera Básica Mujer',
            'price' => 590,
            'category' => 'Remeras y Camisas',
            'gender' => 'Mujer',
            'stock' => 35,
            'description' => 'Remera básica de mujer ideal para uso diario.',
            'sizes' => ['S', 'M', 'L'],
            'image_path' => 'rutas-imagenes/remera-basica-mujer.jpg'
        ]);

        // Producto 5
        Product::create([
            'name' => 'Jean Clásico Mujer',
            'price' => 1490,
            'category' => 'Pantalones',
            'gender' => 'Mujer',
            'stock' => 25,
            'description' => 'Jean ajustado de tiro alto para mujer. Un clásico infaltable.',
            'sizes' => ['S', 'M', 'L'],
            'image_path' => 'rutas-imagenes/jean-clasico.jpg'
        ]);

        // Producto 6
        Product::create([
            'name' => 'Reloj Deportivo Negro',
            'price' => 2190,
            'category' => 'Accesorios',
            'gender' => 'Hombre',
            'stock' => 8,
            'description' => 'Reloj resistente con correa de silicona y cronómetro.',
            'sizes' => ['Único'],
            'image_path' => 'rutas-imagenes/reloj-deportivo.jpg'
        ]);
    }
}
