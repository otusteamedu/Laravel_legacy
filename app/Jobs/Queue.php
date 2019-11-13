<?php
/**
 * Description of Queue.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Jobs;


class Queue
{

    const CONNECTION_DATABASE = 'database';
    const CONNECTION_REDIS = 'redis';
    const CONNECTION_RABBITMQ = 'rabbitmq';

    const DEFAULT = 'default';
    const HIGH = 'high';
    const LOW = 'low';
    const ASSETS = 'assets';

}