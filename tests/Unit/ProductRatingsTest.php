<?php

namespace Tests\Unit;

use App\Http\Livewire\ProductRatings;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class ProductRatingsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_can_set_initial_rating(): void
    {
        $this->actingAs(User::factory()->create());
        $product = Product::create([
            'title' => 'title',
            'slug' => 'test',
            'price' => '0.00'
        ]);

        Livewire::test(ProductRatings::class, ['rating' => 5, 'product' => $product])
            ->assertSet('rating', 5);
    }

    public function test_can_store_rating(): void
    {
        $this->actingAs(User::factory()->create());
        $product = Product::create([
            'title' => 'title',
            'slug' => 'test',
            'price' => '0.00'
        ]);

        Livewire::test(ProductRatings::class, [
            'rating' => 5,
            'comment' => 'lorem ipsm',
            'product' => $product

        ])->call('rate');

        $this->assertTrue(Rating::query()->where('product_id', '=', $product->id)->exists());
    }

    public static function provideRatingData(): array
    {
        return [
            'will throw error when rating is missing' => [
                ['rating' => null, 'comment' => 'lorem ipsum'],
                ['rating']
            ],
            'will throw error when both rating and comment missing' => [
                ['rating' => null, 'comment' => null],
                ['rating', 'comment']
            ],
            'will throw error when comment is missing' =>
                [
                    ['rating' => 5, 'comment' => null],
                    ['comment']
                ],
            'will not throw error' => [
                ['rating' => 5, 'comment' => 'lorem ipsum'],
                []
            ],
        ];
    }

    /**
     * @dataProvider provideRatingData
     */
    public function test_will_respond_with_errors_if_required_fields_are_missing($data, $errorFields): void
    {
        $product = Product::create([
            'title' => 'title',
            'slug' => 'test',
            'price' => '0.00'
        ]);
        $this->actingAs(User::factory()->create());
        $data['product'] = $product;
        if (!empty($errorFields)) {
            Livewire::test(ProductRatings::class, $data)->call('rate')->assertHasErrors($errorFields);
        } else {
            Livewire::test(ProductRatings::class, $data)->call('rate')->assertHasNoErrors();
        }
    }
}
