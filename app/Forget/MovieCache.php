<?php


namespace App\Forget;


use App\Base\ModelCache;

class MovieCache extends ModelCache
{
    public function getForgetKeys(): array {
        $movie = $this->event->getModel();
        $action = $this->event->getAction();

        // тут должны быть проверки
        return ['top_premier', 'rand_showing'];
    }

    public function getForgetTags(): array  {
        return [];
    }
}
