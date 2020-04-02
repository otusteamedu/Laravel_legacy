<?php
/**
 * Description of Status.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Invoices\Entities\Statuses;

use App\Services\Invoices\Exceptions\ModificationProhibitedException;
use App\Services\Invoices\Exceptions\WrongStatusChangeDirectionException;

abstract class Status
{
    /**
     * @property array Class names of next possible statuses
     */
    protected $next = [];

    public function ensureCanBeChangedTo(self $status): void
    {
        if (!$this->canBeChangedTo($status)) {
            throw new WrongStatusChangeDirectionException();
        }
    }

    public function ensureAllowsModification(): void
    {
        if (!$this->allowsModification()) {
            throw new ModificationProhibitedException();
        }
    }

    public function canBeChangedTo(self $status): bool
    {
        $className = get_class($status);

        return in_array($className, $this->next, true);
    }

    public function allowsModification(): bool
    {
        return true;
    }
}
