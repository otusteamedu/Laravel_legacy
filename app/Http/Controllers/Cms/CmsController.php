<?php
/**
 * Description of CmsController.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers\Cms;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{

    protected function setSuccessSavedState()
    {
        request()->session()->flash('successSave', true);
    }

    public function generateQR(Request $request)
    {

    }
}