<?php
/**
 * Description of NewStatus.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Entities\Statuses;


class NewStatus extends Status
{

    protected $next = [ProcessingStatus::class, RejectedStatus::class];

}
