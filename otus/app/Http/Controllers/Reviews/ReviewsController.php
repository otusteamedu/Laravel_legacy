<?php

namespace App\Http\Controllers\Reviews;

use App\Models\Review;
use App\Policies\Abilities;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW_ANY, Review::class);

        return \view('reviews.list', [
            'reviews' => $this->reviewService->searchReviews()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Review::class);


        return view('reviews.create', [
            'users' => $this->userService->searchUsers(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Review::class);

        $this->reviewService->storeReview($request->all());
        return redirect(route('admin.reviews.index'), 301);
    }

    /**
     * @param Review $review
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Review $review) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW, $review);

        return view('reviews.show', [
            'review' => $review
        ]);
    }

    /**
     * @param Review $review
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Review $review) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $review);

        return view('reviews.edit', [
            'review' => $review,
            'users' => $this->userService->searchUsers(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * @param Request $request
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Review $review) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $review);

        $this->reviewService->updateReview($review, $request->all());
        return redirect(route('admin.reviews.index'), 301);
    }

    /**
     * @param Review $review
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Review $review) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::DELETE, $review);

        $this->reviewService->destroyReview([$review->id]);
    }
}
