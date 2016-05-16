<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
        //print_r($videos);
        return response($videos);

    }

    /**
     * Creating a new post
     *
     * @return Response
     */
    public function store(Request $request){


        //$video = new Video;
        //$video->user()->associate(Auth::user());
        //$video->category()->associate($request->category);
        //$video->save();
        $input = $request->all();

        //print_r($input);

        //die();
        //$videos = new Video();
        $create = Auth::user()->videos()->create($input);
        //print_r($create);
        //$create = Video::video()->user()->create($input);
        //echo $create->user_id;
        //$video = Video::user()->get();
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
        $Video = Video::find($id);
        return response($Video);
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
