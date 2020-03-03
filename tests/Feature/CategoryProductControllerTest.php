<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CategoryProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoryProductIndex()
    {
        Auth::loginUsingId(1);

        $response = $this->get(route('admin.category.index'));
        $response->assertStatus(200);
    }

    public function testCategoryProductCreate()
    {
        Auth::loginUsingId(1);

        $response = $this->get(route('admin.category.create'));
        $response->assertStatus(200);
    }

    public function testCategoryProductStore()
    {
        Auth::loginUsingId(1);

        $response = $this->from(route('admin.category.create'))->post(route('admin.category.store'), [
            '_token' => csrf_token(),
            'name' => 'tex t2',
            'description' => 'tex t text',
        ]);

        $response->assertRedirect(route('admin.category.index'));
    }

    public function testCategoryProductEdit()
    {
        Auth::loginUsingId(1);

        $response = $this->from(route('admin.category.index'))->get(route('admin.category.edit', ['category' => 1]));
        $response->assertStatus(200);
    }

    public function testProductDestroy()
    {
        Auth::loginUsingId(1);

        $response = $this->from(route('admin.category.edit', ['category' => 1]))->post(route('admin.category.destroy',
            ['category' => 1,
                '_method' => 'DELETE',
                '_token' => csrf_token(),
            ]
        ));
        $response->assertRedirect(route('admin.category.index'));
    }
}
