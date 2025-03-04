@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $product->name }}</h1>
        <div>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning me-2">Изменить</a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад к списку</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="mb-3">
                <strong>Категория:</strong> {{ $product->category->name }}
            </div>
            <div class="mb-3">
                <strong>Цена:</strong> {{ number_format($product->price, 2, ',', ' ') }} ₽
            </div>
            <div>
                <strong>Описание:</strong>
                <p>{{ $product->description ?: 'Описание отсутствует' }}</p>
            </div>
        </div>
    </div>
@endsection
