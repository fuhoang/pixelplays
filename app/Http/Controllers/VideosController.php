<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\User;
use App\Video;

use Auth;

class VideosController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show all videos
     *
     * @return Response
     */
    public function index(Request $request){

        $input = $request->all();

        if($request->get('search')){
            $videos = Video::where("title", "LIKE", "%{$request->get('search')}%")->paginate(5);
        }else{
            $videos = Video::with('user')->paginate(5);
        }

        return response($videos);

    }

    /**
     * Creating a new post
     *
     * @return Response
     */
    public function store(Request $request){

        $create = Auth::user()->videos()->create($request->all());
        $user = User::find($create->user_id);
        $create->user = $user;

        return response($create);

    }


    /**
     * Find the video by the given id.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        $cat = Category::find($video->category_id);
        $video->category = $cat;
        return response($video);
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
        Video::where("id", $id)->update($input);
        $video = Video::find($id);
        $user = User::find($video->user_id);
        $video->user = $user;
        return response($video);
    }


    /**
     * Delete video
     *
     * @param $id
     * @return bool
     */
    public function destroy($id){
        return Video::where('id', $id)->delete();
    }

}
