<?php

namespace App\Services;

use Collective\Html\FormBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class MacroService extends FormBuilder
{
    /**
     * Show form to delete model
     *
     * @param  Model  $model
     * @param  string  $route
     * @param  string  $method
     * @param  string  $buttonText
     * @param  array  $buttonAttributes
     *
     * @return HtmlString
     */
    public function modelDeleteActionsForm(
        Model $model,
        string $route,
        string $method,
        string $buttonText,
        array $buttonAttributes
    ): HtmlString {
        $output = $this->open(['route' => [$route, $model], 'method' => $method]);
        $output .= $this->submit($buttonText, $buttonAttributes);
        $output .= $this->close();
        
        return $this->toHtmlString($output);
    }
}
