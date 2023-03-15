<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activePortfolios = Portfolio::where('status', 'publish')->get();
        $draftPortfolios = Portfolio::where('status', 'draft')->get();
        $trashPortfolios = Portfolio::onlyTrashed()->orderBy('id', 'desc')->get();
        return view('backend.portfolio.index', compact('activePortfolios', 'draftPortfolios', 'trashPortfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get(['id', 'name']);
        return view('backend.portfolio.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = $request->file('photo');
        $request->validate([
            'category' => 'required',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2000',
        ]);
        if ($photo) {
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->save(public_path('storage/portfolio/' . $photoName));
        }
        Portfolio::create([
            'category_id' => $request->category,
            'photo' => $photoName,

        ]);
        return back()->with('success', 'portfolio Added Successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $categories = Category::get(['id', 'name']);
        return view('backend.portfolio.edit', compact('portfolio', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $photo = $request->file('photo');
        $request->validate([
            'photo' => 'required|mimes:jpg,jpeg,png|max:2000',
            'category' => 'required',
        ]);
        if ($photo) {
            $path = public_path('storage/portfolio/' . $portfolio->photo);
            if (file_exists($path)) {
                unlink($path);
            }
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->save(public_path('storage/portfolio/' . $photoName));
        }
        $portfolio->update([
            $portfolio->category_id = $request->category,
            $portfolio->photo       = $photoName,
        ]);
        return redirect(route('backend.portfolio.index'))->with('success', 'Portfolio Update Successfull!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->status == 'draft';
        $portfolio->save();
        $portfolio->delete();
        return back()->with('success', 'Portfolio Item Trashed');
    }

    public function status(Portfolio $portfolio)
    {
        if ($portfolio->status == 'publish') {
            $portfolio->status = 'draft';
            $portfolio->save();
        } else {
            $portfolio->status = 'publish';
            $portfolio->save();
        }
        return back()->with('success', $portfolio->status == 'publish' ? 'Portfolio info Published' : 'Portfolio info Drafted');
    }
    public function reStore($id)
    {
        $portfolio = Portfolio::onlyTrashed()->find($id);
        $portfolio->restore();
        return back()->with('success', 'Portfolio Item Restored');
    }
    public function permDelete($id)
    {
        $portfolio = Portfolio::onlyTrashed()->find($id);
        $portfolio->forceDelete();
        return back()->with('success', 'Portfolio Item Deleted');
    }
}
