<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->responseSuccess(CategoryResource::collection(Category::paginate(3)));
    }


    public function store(Request $request)
    {
        $category = new Category();
        $category->fill($request->all());
        if ($category->save()) {
            return $this->responseSuccess(
                new CategoryResource($category),
                ['category created successfully'],
                201
            );
        } else {
            return $this->responseError(['category not created, please try again'], 501);
        }

    }


    public function show(Category $cate)
    {
        $cate->load('posts','posts.user','posts.tags');
        return $this->responseSuccess(new CategoryResource($cate));
    }

    public function update(Request $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        return $this->responseSuccess(new CategoryResource($category));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->responseSuccess(null, [], 204);
    }
}
