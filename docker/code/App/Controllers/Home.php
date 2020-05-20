<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller
{
    public function indexAction(): void
    {
        View::render('Home/index.php');
    }

    public function fruitAction(): void
    {
        View::render('Home/fruit.php', [
            'fruit' => ['banana', 'apples', 'tangerine', 'potato'],
        ]);
    }
    public function colorAction(): void
    {
        View::render('Home/color.php', [
            'colors' => ['red', 'green', 'blue'],
        ]);
    }
}
