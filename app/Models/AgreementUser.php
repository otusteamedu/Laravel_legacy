<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AgreementUser extends Pivot
{
    const STATUS_SENT    = "sent";
    const STATUS_AGREE   = "agree";
    const STATUS_REJECT  = "reject";
}
