<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->responseSuccess(CategoryResource::collection(Category::all()));
    }


    public function store(Request $request)
    {
        $category = new Category();
        $category->fill($request->all());
        if ($category->save()) {
            return $this->responseSuccess(
                new PostResource($category),
                ['category created successfully'],
                201
            );
        } else {
            return $this->responseError(['category not created, please try again'], 501);
        }

    }


    public function show(Category $category)
    {
        return $this->responseSuccess(new PostResource($category));
    }

    public function update(Request $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        return $this->responseSuccess(new PostResource($category));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->responseSuccess(null, [], 204);
    }
}
