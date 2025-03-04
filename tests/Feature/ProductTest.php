<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $category = Category::create(['name' => 'Хрупкий']);

        $product = Product::create([
            'name' => 'Стеклянная ваза',
            'category_id' => $category->id,
            'description' => 'Очень хрупкая вещь!',
            'price' => 5000
        ]);

        $this->assertDatabaseHas('products', ['name' => 'Стеклянная ваза']);
    }
}
