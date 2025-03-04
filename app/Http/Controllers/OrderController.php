<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{

    /**
     * Отображение списка всех заказов
     */
    public function index()
    {
        $orders = Order::with('product')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Форма для создания нового заказа
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Сохранение нового заказа
     */
    public function store(OrderRequest $request)
    {
        $data = $request->validated();

        $data['total_price'] = Product::findOrFail($data['product_id'])->price * $data['quantity'];
        Order::create($data);

        return redirect()->route('orders.index')
            ->with('success', 'Заказ успешно создан');
    }

    /**
     * Отображение информации о конкретном заказе
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Обновление статуса заказа на "выполнен"
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()->route('orders.show', $order)
            ->with('success', 'Заказ успешно обновлен');
    }
}
