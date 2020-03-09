<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReviewsService;
use App\Services\Cache\Tag;
use App\Services\Cache\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

use App\Models\Review;

class ReviewsController extends Controller
{
    protected $reviewsService;
    protected $tag;

    const CACHE_SET_TIME_IN_SECONDS = 600;

    public function __construct(
        ReviewsService $reviewsService,
        Tag $tag
    )
    {
        $this->reviewsService = $reviewsService;
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Cache::has(Key::REVIEWS)){
            $reviews = $this->reviewsService->gelAllReviews();
//            Cache::tags([$this->tag::REVIEWS])->put(Key::REVIEWS, $reviews, self::CACHE_SET_TIME_IN_SECONDS);
            Cache::put(Key::REVIEWS, $reviews, self::CACHE_SET_TIME_IN_SECONDS);
        }

        return view('users.reviews.list', [
            'reviews' => Cache::get(Key::REVIEWS),
            'userId' =>  Auth::id(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = $this->reviewsService->hasReview(Auth::id());

        if($result){
            return redirect()->route('reviews.index');
        } else {
            return view('users.reviews.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['review' => 'required|min:1,max:10000']);

        $data = [
            'text' => $request->input('review'),
            'user_id' => Auth::id(),
        ];

        $this->reviewsService->storeReview($data);

        Cache::tags([$this->tag::REVIEWS])->flush();

        return redirect()->route('reviews.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        Gate::authorize('update', $review);
        return view('users.reviews.edit', ['review' => $review]);
    }

    /**$review
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $this->validate($request, ['review' => 'required|min:1,max:10000']);

        $data = [
            'text' => $request->input('review'),
        ];

        $this->reviewsService->updateReview($data, $review);

        Cache::tags([$this->tag::REVIEWS])->flush();

        return redirect()->route('reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Gate::authorize('update', $id);
        $this->reviewsService->destroyReview($id);

        Cache::tags([$this->tag::REVIEWS])->flush();

        return redirect()->route('reviews.index');
    }
}
