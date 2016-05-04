<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Video;

class VideosController extends Controller
{
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
            $videos = Video::paginate(5);
        }
        return response($videos);

    }

    /**
     * Creating a new post
     *
     * @return Response
     */
    public function store(Request $request){
        $input = $request->all();
        $create = Video::create($input);
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
