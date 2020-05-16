<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('articles');

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('published');
            $table->char('title', 100);
            $table->char('short_text', 250);
            $table->text('text');
            $table->integer('category');
            $table->integer('author');
            $table->text('img');
        });
        //test data
        DB::insert('insert into articles (published,title,short_text,text,author,img,category)
            values (?,?,?,?,?,?,?)',[now(),'Article1 title', 'Short text of article', 'Full text of article', 1, 'img/1.jpg', 1]);
        DB::insert('insert into articles (published,title,short_text,text,author,img,category)
            values (?,?,?,?,?,?,?)',[now(),'Article2 title', 'Short text of article', 'Full text of article', 1, 'img/2.jpg', 2]);
        DB::insert('insert into articles (published,title,short_text,text,author,img,category)
            values (?,?,?,?,?,?,?)',[now(),'Article3 title', 'Short text of article', 'Full text of article', 1, 'img/3.jpg', 3]);
        DB::insert('insert into articles (published,title,short_text,text,author,img,category)
            values (?,?,?,?,?,?,?)',[now(),'Article4 title', 'Short text of article', 'Full text of article', 1, 'img/4.jpg', 4]);
        DB::insert('insert into articles (published,title,short_text,text,author,img,category)
            values (?,?,?,?,?,?,?)',[now(),'Article5 title', 'Short text of article', 'Full text of article', 1, 'img/5.jpg', 5]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
