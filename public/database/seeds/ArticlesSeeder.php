 <?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO articles (name, text, img) 
                VALUES (?,?,?)', 
                ['blog post', 
                    'text text uraaaaaaaaaaa',
                    'file.jpg'      
                ]);
        
        DB::table('articles')->insert(
                [
                    [
                        'name' => 'new post',
                        'text' => 'new text',
                        'img' => 'pics.jpg'
                    ],
                    [
                        'name' => 'new post2',
                        'text' => 'new text2',
                        'img' => 'pics.jpg2'
                    ]
                ]
                );
        
        Article::create([
                        'name' => 'new post33',
                        'text' => 'new text33',
                        'img' => 'pics.jpg33'
            
        ]);
    }
}
