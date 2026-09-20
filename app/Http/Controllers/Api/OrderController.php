<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 1. Revisamos que Vue nos haya mandado todo lo necesario
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'total' => 'required|integer',
            'items' => 'required|array', // Esto es el carrito
        ]);

        // 2. Anotamos los datos generales de la clienta (Tabla orders)
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total' => $request->total,
            'status' => 'pendiente', // Arranca como pendiente para que luego lo apruebes
        ]);

        // 3. Recorremos el carrito y anotamos prenda por prenda (Tabla order_items)
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id, // Lo vinculamos al pedido de arriba
                'product_id' => $item['id'],
                'size' => $item['talle'], // Talle elegido
                'quantity' => $item['cantidad'], // Cuántas unidades de este talle
                'price' => $item['precio'], // Guardamos el precio al momento de la compra
            ]);
        }

        // 4. Le avisamos a Vue que la compra se anotó perfecto
        return response()->json([
            'message' => '¡Pedido creado con éxito!',
            'order_id' => $order->id
        ], 201);
    }
}
