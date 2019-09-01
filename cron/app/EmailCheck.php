<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 17.08.2019
 * Time: 14:09
 */

namespace cron\app;


class EmailCheck extends LeadInfo
{

    protected function queryBD(): ChekerLeadInfo
    {
        return new Email();
    }
}