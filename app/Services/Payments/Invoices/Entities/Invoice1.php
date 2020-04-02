<?php
/**
 * Description of Invoice.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Entities;

use App\Services\Invoices\Entities\Statuses\Status;
use App\Services\Invoices\Exceptions\WrongStatusChangeDirectionException;
use App\Services\Item\Entities\LineItem;
use Illuminate\Support\Collection;

class Invoice1
{

    /** @var Status */
    private $status;
    /** @var Collection */
    private $line;

    /**
     * @param Status $status
     * @throws WrongStatusChangeDirectionException
     */
    public function changeStatus(Status $status)
    {
        $this->status->ensureCanBeChangedTo($status);

        $this->status = $status;
    }

    public function addLineItem(LineItem $line)
    {
        $this->status->allowsModification();

        $this->line->push($line);
    }

    public function removeLineItem(LineItem $line)
    {
        $this->status->allowsModification();

    }

}
