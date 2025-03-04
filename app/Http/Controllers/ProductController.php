<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Отображение списка всех товаров
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Форма для создания нового товара
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Сохранение нового товара
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.create')
            ->with('success', 'Товар успешно добавлен. Можете добавить еще один.');
    }

    /**
     * Отображение информации о конкретном товаре
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Форма для редактирования товара
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Обновление товара
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')
            ->with('success', 'Товар успешно обновлен');
    }

    /**
     * Удаление товара
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Товар успешно удален');
    }
}
