<?php

namespace App\Http\Controllers\Web\Admin\Languages;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Policies\Abilities;
use Illuminate\Http\Request;

/**
 * Class LanguagesController
 * @package App\Http\Controllers\Web\Admin\Languages
 */
class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Language::class);

        return view('admin.languages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, Language::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize(Abilities::UPDATE, Language::class);
    }

    /**
     * Display the specified resource.
     *
     * @param Language $language
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Language $language)
    {
        $this->authorize(Abilities::VIEW, Language::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Language $language
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Language $language)
    {
        $this->authorize(Abilities::UPDATE, Language::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Language $language
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Language $language)
    {
        $this->authorize(Abilities::UPDATE, Language::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Language $language
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Language $language)
    {
        $this->authorize(Abilities::DELETE, Language::class);
    }
}
