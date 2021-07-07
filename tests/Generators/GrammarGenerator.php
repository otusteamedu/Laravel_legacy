<?php


namespace Tests\Generators;


class GrammarGenerator
{
    public static function getCreateGrammarData(): array
    {
        return factory(\App\Models\Grammar::class)->make()->toArray();
    }

    public static function getUpdateGrammarData($id, $update = []): array
    {

        $array = factory(\App\Models\Grammar::class)->make()->toArray();
        $array['id'] = $id;
        foreach ($update as $key => $item) {
            $array[$key] = $item;
        }
        return $array;
    }
}
