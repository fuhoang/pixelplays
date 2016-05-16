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
        //print_r($create);
        return response($create);
    }

    /**
     * Find the category by the given id.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return response($category);
    }

    /**
     * update the edited video.
     *
     * @param Request $request
     * @param Request $id
     * @return Response
     */
    public function update(Request $request, $id){
        $input = $request->all();
        Category::where("id", $id)->update($input);
        $category = Category::find($id);
        return response($category);
    }

    /**
     * Delete video
     *
     * @param $id
     * @return bool
     */
    public function destroy($id){
        return Category::where('id', $id)->delete();
    }
}
