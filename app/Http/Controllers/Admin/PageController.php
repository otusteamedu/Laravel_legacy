<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = Page::orderBy('id')->paginate(10); //
        return view('admin/pages/page', ['list' =>$pages,'editRoute'=>'pages.edit']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pages/add', ['addRoute'=>'pages.create','backRoute'=>'pages']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
           ]);

        Page::create($request->all());
        return redirect()->back()->with('success','Create Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pageFields = Page::findOrFail($id);

        return view('admin/pages/edit',[
            'fields'=>$pageFields, 'updateRoute'=>'pages.update','backRoute'=>'pages']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $page = Page::find($id);
        $page->title = $request->title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_title = $request->meta_title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();

        return redirect(route('pages.edit',['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::where('id',$id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
