<?php
/**
 * Description of ImportDocumentController.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers\API;


use App\Services\Documents\DocumentsService;
use Illuminate\Http\Request;

class DocumentController
{

    private $documentsService;

    public function __construct(
        DocumentsService $documentsService
    )
    {
        $this->documentsService = $documentsService;
    }

    public function import(Request $request)
    {
        $job = $this->documentsService->startImport($request->file('document'));


        return response()->json([
           'id' => $job,
        ]);
    }

    public function progress(string $job)
    {
        $job = $this->documentsService->getProgress($job);

        return response()->json([
            'id' => $job,
        ]);
    }

}
