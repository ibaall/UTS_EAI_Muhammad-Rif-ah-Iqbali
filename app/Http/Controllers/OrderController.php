<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; //
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        $result = [];

        foreach ($orders as $order) {
            $orderData = $order->toArray(); // ubah jadi array

            // Ambil user dari UserService
            $response = Http::get("http://127.0.0.1:8000/api/users/{$order->user_id}");

            if ($response->successful()) {
                $orderData['user'] = $response->json()['data'];
            }

            $result[] = $orderData;
        }

        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }


public function createOrder(Request $request)
{
    $userId = $request->input('user_id');

    // Ambil data user dari UserService
    $userResponse = Http::get("http://127.0.0.1:8000/api/users/{$userId}");

    if ($userResponse->failed()) {
        return response()->json(['message' => 'User not found in UserService'], 404);
    }

    $userData = $userResponse->json()['data'];

    // Simpan order (anggap produk dan quantity dikirim dari request)
    $order = Order::create([
        'user_id' => $userId,
        'product' => $request->input('product'),
        'quantity' => $request->input('quantity'),
    ]);

    return response()->json([
        'message' => 'Order created',
        'order' => $order,
        'user' => $userData
    ], 201);
}
    public function show($id)
    {
        $order = Order::find($id);

        if ($order) {
            return response()->json([
                'status' => 'success',
                'data' => $order
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Order not found'
        ], 404);
    }
    public function history($userId)
    {
        // Cek apakah user ada di UserService
        $userResponse = Http::get("http://127.0.0.1:8000/api/users/{$userId}");

        if ($userResponse->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found in UserService'
            ], 404);
        }

        // Ambil semua order milik user ini
        $orders = Order::where('user_id', $userId)->get();

        return response()->json([
            'status' => 'success',
            'data' => $orders
        ]);
    }
    public function orderHistory($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $userId = $order->user_id;
        return $this->history($userId); // panggil method yang sudah ada
    }
    public function updateStatus(Request $request, $id)
{
    $order = Order::find($id);
    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    $request->validate([
        'status' => 'required|in:pending,shipped,completed,cancelled',
    ]);

    $order->status = $request->status;
    $order->save();

    return response()->json([
        'message' => 'Order status updated',
        'order' => $order
    ]);
}


}
