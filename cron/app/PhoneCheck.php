<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 16.08.2019
 * Time: 22:28
 */

namespace cron\app;


class PhoneCheck extends LeadInfo
{

    protected function queryBD(): ChekerLeadInfo
    {
        return new Phone();
    }
}
