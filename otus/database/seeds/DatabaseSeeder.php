<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AuthorTableSeeder::class);
         $this->call(CategoryTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(HandbookTableSeeder::class);
         $this->call(SelectionMaterialsSeeder::class);
         $this->call(JournalTableSeeder::class);
         $this->call(MaterialsTableSeeder::class);
         $this->call(ReadMaterialsSeeder::class);
         $this->call(FavoritesTableSeeder::class);
         $this->call(ReviewsTableSeeder::class);
         $this->call(CompilationsTableSeeder::class);
    }
}
