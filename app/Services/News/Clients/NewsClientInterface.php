<?php
/**
 * Description of NewsClientInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\News\Clients;


interface NewsClientInterface
{

    public function latest(): array;

}
