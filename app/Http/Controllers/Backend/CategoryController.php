<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeCategorys = Category::where('status', 'publish')->get();
        $draftCategorys = Category::where('status', 'draft')->get();
        $trashCategorys = Category::onlyTrashed()->orderBy('id', 'desc')->get();
        return view('backend.category.index', compact('activeCategorys', 'draftCategorys', 'trashCategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'  => 'required|unique:categories,name',
        ]);
        Category::create([
            'name'  => $request->name,

        ]);
        return back()->with('success', 'Category Added Successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name'  => 'required|unique:categories,name',
        ]);

        $category->name = $request->name;
        $category->save();


        return redirect(route('backend.category.index'))->with('success', 'Category info Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->status == 'draft';
        $category->save();
        $category->delete();
        return back()->with('success', 'Category Item Trashed');
    }

    public function status(Category $category)
    {
        if ($category->status == 'publish') {
            $category->status = 'draft';
            $category->save();
        } else {
            $category->status = 'publish';
            $category->save();
        }
        return back()->with('success', $category->status == 'publish' ? 'Category info Published' : 'Category info Drafted');
    }
    public function reStore($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->restore();
        return back()->with('success', 'Category Item Restored');
    }
    public function permDelete($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();
        return back()->with('success', 'Category Item Deleted');
    }
}
