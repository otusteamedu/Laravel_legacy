<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * Class ProductControllerTest
 * @package Tests\Feature
 * @group TestProductController
 */
class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testProductIndex()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $response = $this->get(route('admin.product.index'));
        $response->assertStatus(200);
    }

    /**
     * @group ProductCreateTest
     */
    public function testProductCreate()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $category = CategoryProductControllerTest::createTestCategory();

        $response = $this->from(route('admin.product.index'))->get(route('admin.product.create',[
            'category_id' => $category->id,
        ]));

        $response->assertStatus(200);
    }

    public function testProductStore()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $category = CategoryProductControllerTest::createTestCategory();

        $response = $this->from(route('admin.product.create'))->post(route('admin.product.store'), [
            '_token' => csrf_token(),
            'name' => 'tet2',
            'description' => 'tex t text',
            'price' => rand(1000, 3000),
            'category_id' => $category->id,
        ]);

        $response->assertRedirect(route('admin.product.index'));
    }

    /**
     * @group ProductEditTest
     */
    public function testProductEdit()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $category = CategoryProductControllerTest::createTestCategory();
        $product = $this->createTestProduct($category);

        $response = $this->from(route('admin.product.index'))->get(route('admin.product.edit',['product'=>$product->id]));
        $response->assertStatus(200);
    }

    /**
     *
     * @group ProductUpdateTest
     */
    public function testProductUpdate()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $category = CategoryProductControllerTest::createTestCategory();
        $product = $this->createTestProduct($category);

        $response = $this->from(route('admin.product.edit',$product->id))->post(route('admin.product.update',

            [
                'product' => $product->id,
                '_method' => 'PUT',
                '_token' => csrf_token(),
                'name' => 'new name',
                'description' => 'tex t text',
                'price' => rand(1000, 3000),
                'category_id' => $category->id,
            ],
            $product
        ));
        $response->assertStatus(200);
    }

    public function testProductDestroy()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $category = CategoryProductControllerTest::createTestCategory();
        $product = $this->createTestProduct($category);

        $response = $this->from(route('admin.product.edit',['product' => 1]))->post(route('admin.product.destroy',
            [
                'product' => $product->id,
                '_method' => 'DELETE',
                '_token' => csrf_token(),
            ]
        ));
        $response->assertRedirect(route('admin.product.index'));
    }


    public static function createTestProduct($category){
        return factory(Product::class)->create([
            'category_id' => $category->id,
        ]);
    }

}


