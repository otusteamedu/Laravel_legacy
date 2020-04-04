<?php

use Illuminate\Database\Seeder;

class BlogAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\File::class, 1)->create([
            'usage' => App\Models\File::USAGE_BLOG_AUTHOR_AVATAR
        ])->each(function ($detailImage) {
            $user = App\Models\User::find(1)->first();

            factory(App\Models\Blog\Author::class, 1)->create([
                'created_by_id' => $user->id,
                'photo_id' => $detailImage->id
            ]);
        });
    }
}
