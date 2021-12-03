<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponse;

    public function index()
    {
//        dd((PostResource::collection(Post::paginate())));
        return $this->responseSuccess(PostResource::collection(Post::paginate(1)));
    }


    public function store(Request $request)
    {
        $post = new Post();
        $post->fill($request->all());
        if ($post->save()) {
            return $this->responseSuccess(
                new PostResource($post),
                ['post created successfully'],
                201
            );
        } else {
            return $this->responseError(['post not created, please try again'], 501);
        }

    }


    public function show(Post $post)
    {
//        $cate= $post::with('cate')->get();
//        dd($cate);
//        $post->$cate;

        $post->load('user','tags','cate');
        return $this->responseSuccess(new PostResource($post));
    }

    public function update(Request $request, Post $post)
    {
        $post->fill($request->all());
        $post->save();
        return $this->responseSuccess(new PostResource($post));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $this->responseSuccess(null, [], 204);
    }
}
