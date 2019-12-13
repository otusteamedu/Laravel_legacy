<?php

use App\Models\Podcast;
use App\User;
use Illuminate\Database\Seeder;

class PodcastsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создим несколько рандомных подкастов
        $this->createPodcasts();

        // Первый по алфавиту обязательно привяжем к пользователю admin, чтобы при просмотре приложения было видно
        // хотя бы один подкаст
        $this->attachFirstPodcastToAdmin();

        // Остальные подкасты привязываем у другим пользователям в случаном порядке
        $this->attachPodcastsToRandomUsers();
    }

    private function createPodcasts()
    {
        factory(Podcast::class, 45)->create();
    }

    private function attachFirstPodcastToAdmin()
    {
        $adminUser = User::where(['email' => 'admin@example.com'])->first();
        // Берём первый подкаст по алфавиту
        Podcast::orderBy('name')->first()->users()->attach($adminUser);
    }

    private function attachPodcastsToRandomUsers()
    {
        $users = User::all();
        // Найдём подкасты, которые ещё не привязаны к пользователям
        Podcast::doesntHave('users')->each(function ($podcast) use ($users) {
            $randomUser = $users->random();
            /** @var Podcast $podcast */
            $podcast->users()->attach($randomUser);
        });
    }
}
