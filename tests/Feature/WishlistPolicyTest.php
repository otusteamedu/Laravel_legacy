<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class WishlistActionsTest
 *
 * @package Tests\Feature
 */
class WishlistPolicyTest extends TestCase
{
    use RefreshDatabase;

    public $users;
    public $wishlists;

    public function setUp() :void
    {
        parent::setUp();

        $this->users = factory(User::class, 3)
            ->states(['active', 'customer'])
            ->create()
            ->each(function ($user) {
                $this->wishlists[] = factory(Wishlist::class)->create([
                    'user_id' => $user->id,
                ]);
            });
    }

    public function testUnauthUserCantViewWishlists()
    {
        $response = $this->get(route('wishlists.show', $this->wishlists[0]->id));

        $response->assertRedirect(route('login'));
    }

    public function testCantViewWishlistsAnotherUser()
    {
        \Auth::loginUsingId($this->wishlists[0]->user_id);

        $response = $this->get(route('wishlists.show', $this->wishlists[1]->id));

        $response->assertForbidden();
    }

    public function testUnauthUserCantDeleteWishlists()
    {
        $this->from(route('wishlists.index'))
            ->delete(route('wishlists.destroy', $this->wishlists[0]->id));

        $this->assertDatabaseHas('wishlists', $this->wishlists[0]->toArray());
    }

    public function testAnotherUserCantDeleteWishlists()
    {
        \Auth::loginUsingId($this->wishlists[1]->user_id);

        $this->from(route('wishlists.index'))
            ->delete(route('wishlists.destroy', $this->wishlists[0]->id));

        $this->assertDatabaseHas('wishlists', $this->wishlists[0]->toArray());
    }

    public function testUserCanDeleteWishlists()
    {
        \Auth::loginUsingId($this->wishlists[0]->user_id);

        $this->from(route('wishlists.index'))
            ->delete(route('wishlists.destroy', $this->wishlists[0]->id));

        $this->assertDeleted('wishlists', $this->wishlists[0]->toArray());
    }

}
