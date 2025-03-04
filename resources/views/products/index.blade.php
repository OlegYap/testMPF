@extends('layouts.app')

@section('title', 'Список товаров')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Список товаров</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить товар</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Нет категории' }}</td>
                    <td>{{ number_format($product->price, 2, ',', ' ') }} ₽</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info me-2">Просмотр</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning me-2">Изменить</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Вы уверены?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Товары не найдены</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
