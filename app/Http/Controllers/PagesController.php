<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class PagesController extends Controller
{

    /**
     * Display home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $homeNav = 'home';
        $categoryIds = Category::lists('id', 'id');
        $productList = array();
        foreach ($categoryIds as $categoryId) {
            $productList[$categoryId] = Category::findOrFail($categoryId)
                ->products()->latest()->available()->take(4)->get();
        }
        return view('index', compact('homeNav', 'productList'));
    }
}
