<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order()
    {
        $category = Category::create(['name' => 'Легкий']);
        $product = Product::create([
            'name' => 'Тестовый товар',
            'category_id' => $category->id,
            'description' => 'Описание тестового товара',
            'price' => 1999
        ]);

        $response = $this->post(route('orders.store'), [
            'customer_name' => 'Иван Иванов',
            'product_id' => $product->id,
            'quantity' => 2,
            'comment' => 'Тестовый комментарий'
        ]);

        $response->assertRedirect(route('orders.index'));
        $this->assertDatabaseHas('orders', ['customer_name' => 'Иван Иванов']);
    }

    /** @test */
    public function it_fails_validation_when_creating_order_without_required_fields()
    {
        $response = $this->post(route('orders.store'), []);
        $response->assertSessionHasErrors(['customer_name', 'product_id', 'quantity']);
    }
}
