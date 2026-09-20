<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->orderBy('created_at', 'desc')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'total' => 'required|integer',
            'items' => 'required|array',
        ]);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total' => $request->total,
            'status' => 'Pendiente',
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'size' => $item['talle'],
                'quantity' => $item['cantidad'],
                'price' => $item['precio'],
            ]);
        }

        return response()->json(['message' => '¡Pedido creado con éxito!', 'order_id' => $order->id], 201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        if ($request->status === 'Entregado') {
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product && $product->stock >= $item->quantity) {
                    $product->stock = $product->stock - $item->quantity;
                    $product->save();
                }
            }
        }

        return response()->json(['message' => 'Estado actualizado']);
    }

    // --- NUEVA FUNCIÓN: Para borrar definitivamente ---
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Primero borramos las prendas asociadas a este pedido para que no queden sueltas
        $order->items()->delete();
        // Ahora sí borramos el pedido de la base de datos
        $order->delete();

        return response()->json(['message' => 'Pedido eliminado de la base de datos']);
    }
}
