<?php

namespace Tests\Feature;

use App\Models\CategoryProduct;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CategoryProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoryProductIndex()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $response = $this->get(route('admin.category.index'));
        $response->assertStatus(200);
    }
    /**
     *
     * @group CategoryProductCreateTest
     */
    public function testCategoryProductCreate()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $response = $this->from(route('admin.category.index'))->get(route('admin.category.create'));
        $response->assertStatus(200);
    }

    public function testCategoryProductStore()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $response = $this->from(route('admin.category.create'))->post(route('admin.category.store'), [
            '_token' => csrf_token(),
            'name' => 'tex t2',
            'description' => 'tex t text',
        ]);

        $response->assertRedirect(route('admin.category.index'));
    }

    public function testCategoryProductEdit()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $category = CategoryProductControllerTest::createTestCategory();

        $response = $this->from(route('admin.category.index'))->get(route('admin.category.edit', ['category' => $category->id]));
        $response->assertStatus(200);
    }
    /**
     *
     * @group CategoryUpdateTest
     */
    public function testCategoryUpdate()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $category = CategoryProductControllerTest::createTestCategory();

        $response = $this->from(route('admin.category.edit',$category->id))->post(route('admin.category.update',
            [
                '_token' => csrf_token(),
                '_method' => 'PUT',
                'name' => 'tex t2',
                'description' => 'tex t text',
                'category' => $category->id,
            ],
            $category
        ));
        $response->assertStatus(200);
    }

    public function testProductDestroy()
    {
        $user = LoginControllerTest::usersGenerator('admin');
        Auth::login($user);

        $category = CategoryProductControllerTest::createTestCategory();

        $response = $this->from(route('admin.category.edit', ['category' => $category->id]))->post(route('admin.category.destroy',
            ['category' => 1,
                '_method' => 'DELETE',
                '_token' => csrf_token(),
            ]
        ));
        $response->assertRedirect(route('admin.category.index'));
    }

    public static function createTestCategory(){

        return factory(CategoryProduct::class)->create();
    }
}
