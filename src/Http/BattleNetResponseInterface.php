<?php

namespace Gerfey\BattleNet\Http;

interface BattleNetResponseInterface
{
    public function getJson();

    public function getStatusCode();
}