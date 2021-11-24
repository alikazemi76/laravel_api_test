<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Resources\Json\JsonResource;

class  TagResource extends JsonResource
{

    public function toArray($request)
    {
//        $post = Post:: with('tags')->get();
        $post = Post:: with('tags')->get();
        return [
            'id' => $this->id,
            'name' => $this->name,
//            'posts' => $this->whenLoaded('posts')
//            'posts' =>$post
            'posts' => PostResource::collection($this->whenLoaded('posts')),
        ];
    }
}
