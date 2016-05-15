<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Show all videos
     *
     * @return Response
     */
    public function index(Request $request){
    	$input = $request->all();
    	$cat = Category::all();
    	//print_r($cat);
        return response($cat);
    }


    /**
     * Creating a new post
     *
     * @return Response
     */
    public function store(Request $request){
        $input = $request->all();
        $create = Category::create($input);
        print_r($create);
        return response($create);

    }
}
