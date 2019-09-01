<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 17.08.2019
 * Time: 14:31
 */
namespace cron\app;


class EmptyCheck extends LeadInfo
{

    protected function queryBD(): ChekerLeadInfo
    {
        return new EmptyBD();
    }
}