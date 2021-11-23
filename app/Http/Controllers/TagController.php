<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Post;
use App\Models\Tag;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->responseSuccess(TagResource::collection(Tag::all()));
    }


    public function store(Request $request)
    {
        $tag = new Tag();
        $tag->fill($request->all());
        if ($tag->save()) {
            return $this->responseSuccess(
                new TagResource($tag),
                ['tag created successfully'],
                201
            );
        } else {
            return $this->responseError(['tag not created, please try again'], 501);
        }

    }


    public function show(Tag $tag,Post  $post)
    {
        $tag->load('posts');

        return $this->responseSuccess(new TagResource($tag));
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->fill($request->all());
        $tag->save();
        return $this->responseSuccess(new TagResource($tag));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->responseSuccess(null, [], 204);
    }
}
