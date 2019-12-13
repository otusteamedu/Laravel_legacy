<?php


namespace App\Helpers;


class ViewHelpers
{
    public static function phpInsightsCssClass($value)
    {
        if ($value > 90) {
            return 'alert alert-success';
        }

        if ($value > 50) {
            return 'alert alert-warning';
        }

        return 'alert alert-danger';
    }
}
