<?php
/**
 * Description of BladeStatements.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Providers\Views;

use Blade;

trait BladeStatements
{

    public function bootBladeStatements()
    {
        $this->bootDirectiveDate();
        $this->bootDirectiveMoney();
    }
    /**
     * @param null $format
     *
     * @date($date, 'd.m.Y')
     */
    private function bootDirectiveDate($format = null)
    {
        Blade::directive('date', function ($expression) use ($format) {
            $format = $format ?: 'd.m.Y';
            return "<?php  if(!$expression == null) echo ($expression)->format('$format'); ?>";
        });
    }

    /**
     * @money($value)
     */
    private function bootDirectiveMoney()
    {
        Blade::directive('money', function ($expression) {
            $currency = config('app.currency', '$');
            return "<?php echo ('$currency ' . $expression); ?>";
        });
    }

}
