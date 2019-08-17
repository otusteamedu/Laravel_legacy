<?php
/**
 * Created by PhpStorm.
 * User: Hollow
 * Date: 16.08.2019
 * Time: 22:12
 */

namespace cron\app;


abstract class LeadInfo
{
    // factory method
    abstract protected function queryBD(): ChekerLeadInfo;

    public function takeType($params)
    {
        $query = $this->queryBD();
        return  $query->queryBDrequest($params);
    }
}