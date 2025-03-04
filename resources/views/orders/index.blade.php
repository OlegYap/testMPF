@extends('layouts.app')

@section('title', 'Список заказов')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Список заказов</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Создать заказ</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Дата создания</th>
                <th>ФИО покупателя</th>
                <th>Статус</th>
                <th>Итоговая цена</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>
                            <span class="badge bg-{{ $order->status == 'новый' ? 'primary' : 'success' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                    </td>
                    <td>{{ number_format($order->total_price, 2, ',', ' ') }} ₽</td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">Просмотр</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Заказы не найдены</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $orders->links() }}
@endsection
