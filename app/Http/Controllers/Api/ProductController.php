<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product; // Importamos el modelo que tiene los datos
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // 1. Le pedimos al modelo que traiga TODOS los productos de la base de datos
        $products = Product::all();

        // 2. Los devolvemos convertidos a formato JSON para que Vue los pueda leer
        return response()->json($products);
    }
}
