<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Response;
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
            $videos = Video::with('user')->paginate(20);
        }

        //return response($videos);


        return Response::json([
            'videos' => $this->transformCollection($videos)
            //'data' => $videos
        ], 200);

    }

    /**
     * Show all videos
     *
     * @return Response
     */
    public function show($id){
        $video = Video::with('user')->find($id);
        //return response($video);
        if(!$video){
            return Response::json([
                'error' => [
                    'message' => 'Video does not exist'
                    ]
            ], 404);
        }

        return Response::json([
            'video' => $this->transform($video)
        ], 200);

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
        //return response($create);

        return Response::json([
            'message' => 'Video Created Successfully',
            'videos' => $this->transform($create)
        ], 200);

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
        //$video->category = $cat;

        return Response::json([
            'video' => $this->transform($video, $cat)
            //'category'=> $cat
        ], 200);


    }


    /**
     * update the edited video.
     *
     * @param Request $request
     * @param Request $id
     * @return Response
     */
    public function update(Request $request, $id){

        Video::where("id", $id)->update($request->all());
        $video = Video::with('user')->find($id);
        return Response::json([
            'message' => 'Video Updated Successfully',
            'video' => $this->transform($video)
        ], 200);

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


    private function transformCollection($videos){

        $videosArray = $videos->toArray();

        return array_map([$this, 'transform'], $videosArray['data']);
    }

    private function transform($video, $category = null){

        $transform = [
            'id' => $video['id'],
            'title' => $video['title'],
            'description' => $video['description'],
            'video_link' => $video['video_link'],
            'user' => [
                'id' => $video['user']['id'],
                'created_by' => $video['user']['name'],
                'email' => $video['user']['email']
            ]
        ];

        if($category != null){
            $transform['category'] = $category;

        }






        return $transform;
    }
}
