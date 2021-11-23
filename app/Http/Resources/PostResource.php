<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        $cate= Category::all();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user' => $this->whenLoaded('user'),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'cate' => $this->whenLoaded('cate'),
        ];
    }
}
