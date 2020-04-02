<?php
/**
 * Description of Invoice.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Entities;


use App\Services\Invoices\Entities\Statuses\Status;
use App\Services\Invoices\Exceptions\ModificationProhibitedException;
use App\Services\Invoices\Exceptions\WrongStatusChangeDirectionException;
use App\Services\Item\Entities\LineItem;
use Illuminate\Support\Collection;

class Invoice
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
        if (!$this->status->canBeChangedTo($status)) {
            throw new WrongStatusChangeDirectionException();
        }

        $this->status = $status;
    }

    public function addLineItem(LineItem $line)
    {
        if (!$this->status->allowsModification()) {
            throw new ModificationProhibitedException();
        }

        $this->line->push($line);
    }

    public function removeLineItem(LineItem $line)
    {
        if (!$this->status->allowsModification()) {
            throw new ModificationProhibitedException();
        }
    }

}
