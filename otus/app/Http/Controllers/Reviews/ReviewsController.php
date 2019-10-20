<?php

namespace App\Http\Controllers\Reviews;

use App\Models\Review;
use App\Services\Materials\MaterialService;
use App\Services\Reviews\ReviewService;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller {

    protected $reviewService;
    protected $userService;
    protected $materialService;

    public function __construct(ReviewService $reviewService, UserService $userService, MaterialService $materialService) {
        $this->reviewService = $reviewService;
        $this->userService = $userService;
        $this->materialService = $materialService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return \view('reviews.list', [
            'reviews' => $this->reviewService->searchReviews()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('reviews.create', [
            'users' => $this->userService->searchUsers(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->reviewService->storeReview($request->all());
        return redirect(route('admin.reviews.index'), '301');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review) {
        return view('reviews.show', [
            'review' => $review
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review) {
        return view('reviews.edit', [
            'review' => $review,
            'users' => $this->userService->searchUsers(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review) {
        $this->reviewService->updateReview($review, $request->all());
        return redirect(route('admin.reviews.index'), '301');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review) {
        $this->reviewService->destroyReview([$review->id]);
    }
}
