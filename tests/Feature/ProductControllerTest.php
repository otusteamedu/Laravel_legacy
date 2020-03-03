<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testProductIndex()
    {
        Auth::loginUsingId(1);

        $response = $this->get(route('admin.product.index'));
        $response->assertStatus(200);
    }

    public function testProductCreate()
    {
        Auth::loginUsingId(1);

        $response = $this->get(route('admin.product.create'));
        $response->assertStatus(200);
    }

    public function testProductStore()
    {
        Auth::loginUsingId(1);

        $response = $this->from(route('admin.product.create'))->post(route('admin.product.store'), [
            '_token' => csrf_token(),
            'name' => 'tet2',
            'description' => 'tex t text',
            'price' => rand(1000, 3000),
            'category_id' => rand(1, 3),
        ]);

        $response->assertRedirect(route('admin.product.index'));
    }

    public function testProductEdit()
    {
        Auth::loginUsingId(1);

        $response = $this->from(route('admin.product.index'))->get(route('admin.product.edit',['product'=>1]));
        $response->assertStatus(200);
    }

//    public function testProductUpdate()
//    {
//        Auth::loginUsingId(1);
//
//        $response = $this->from(route('admin.product.edit',['product'=>1]))->get(route('admin.product.update',
//            ['_token' => csrf_token(),
//            'name' => 'tet2',
//            'description' => 'tex t text',
//            'price' => rand(1000, 3000),
//            'category_id' => rand(1, 3),
//                ],
//            Product::class
//        ));
//        $response->assertStatus(200);
//    }

    public function testProductDestroy()
    {
        Auth::loginUsingId(1);

        $response = $this->from(route('admin.product.edit',['product' => 1]))->post(route('admin.product.destroy',
            [
                'product' => 1,
                '_method' => 'DELETE',
                '_token' => csrf_token(),
            ]
        ));
        $response->assertRedirect(route('admin.product.index'));
//        dd($response);
    }

}


