@extends('layouts.app')

@section('title', 'Заказ #' . $order->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Заказ #{{ $order->id }}</h1>
        <div class="d-flex gap-2">
            <form action="{{ route('orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="выполнен">
                <button type="submit" class="btn btn-success">Отметить как выполненный</button>
            </form>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад к списку</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Информация о заказе</h5>
        </div>
        <div class="card-body">
            <p><strong>ФИО покупателя:</strong> {{ $order->customer_name }}</p>
            <p><strong>Дата создания:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Статус:</strong>
                <span class="badge bg-{{ $order->status == 'новый' ? 'primary' : 'success' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Итоговая цена:</strong> {{ number_format($order->total_price, 2, ',', ' ') }} ₽</p>
            <p><strong>Комментарий:</strong> {{ $order->comment ?: 'Комментарий отсутствует' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Информация о товаре</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Категория</th>
                    <th>Цена за единицу</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $order->product->name ?? 'Неизвестный товар' }}</td>
                    <td>{{ $order->product->category->name ?? 'Неизвестная категория' }}</td>
                    <td>{{ number_format($order->product->price ?? 0, 2, ',', ' ') }} ₽</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ number_format($order->total_price, 2, ',', ' ') }} ₽</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
