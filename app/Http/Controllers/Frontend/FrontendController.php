<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    /* process one */

    public static function get_images($category)
    {
        $images = Portfolio::whereIn('category_id', function ($query) use ($category) {
            $query->select('id')
                ->from(with(new Category())->getTable())
                ->where('name', $category)
                ->where('status', 'publish');
        })->get();
        return $images;
    }


    /* process two
     public function index(){
        $vehicles = Portfolio::whereIn('category_id', function ($query) {
            $query->select('id')
            ->from(with(new Category())->getTable())           
            ->where('name', 'Vehicle')
            ->where('status', 'publish');
        })->get();
        $animals = Portfolio::whereIn('category_id', function ($query) {
            $query->select('id')
            ->from(with(new Category())->getTable())           
            ->where('name', 'Animal')
            ->where('status', 'publish');
        })->get();
        $workstations = Portfolio::whereIn('category_id', function ($query) {
            $query->select('id')
            ->from(with(new Category())->getTable())           
            ->where('name', 'Work Station')
            ->where('status', 'publish');
        })->get();
        return view('frontend.index',compact('vehicles', 'animals', 'workstations'));
    } */
}
