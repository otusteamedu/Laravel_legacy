<?php

namespace App\Http\Controllers\Cms\Segments;

use App\Http\Controllers\Cms\Segments\Requests\StoreSegmentRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Segments\Requests\StoreCityRequest;
use App\Models\Segment;
use App\Services\Segments\SegmentsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use View;


class SegmentsController extends Controller
{
    /**
     * @var SegmentsService
     */
    protected $segmentsService;

    public function __construct(
        SegmentsService $segmentsService
    )
    {
        $this->segmentsService = $segmentsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cms.segments.index', ['segments' => Segment::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Gate::allows('create-segment')) {
            return view('cms.segments.create');
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreSegmentRequest $request)
    {
        $data = $request->getFormData();

        try {
            $this->segmentsService->storeSegment($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store segment error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route('cms.segments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Segment  $segment
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Segment $segment)
    {
        return view('cms.segments.show', [
            'segment' => $segment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Segment  $segment
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Segment $segment)
    {
        if (Gate::allows('update-segment')) {
            return view('cms.segments.edit', [
                'segment' => $segment,
            ]);
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segment  $segment
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Segment $segment)
    {
        $this->authorize(Abilities::UPDATE, $segment);

        try {
            $this->segmentsService->updateSegment($segment, $request->all());
            $segment->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update segment error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route('cms.segments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segment $segment)
    {
        //
    }
}
