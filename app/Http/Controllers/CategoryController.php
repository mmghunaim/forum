<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index','show']]);
    }

    public function index()
    {
        return CategoryResource::collection(Category::latest()->get());
    }

    public function store(CategoryRequest $request)
    {
        // Category::create($request->all());
        $request['slug'] = str_slug($request->input('name'));
        $category = auth()->user()->categories()->create($request->all());
        return response(new CategoryResource($category),Response::HTTP_CREATED);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->input('name');
        $category->slug = str_slug($request->input('name'));
        $category->save();

        // $category->update([
        //     'name' => $request->input('name'),
        //     'slug' => str_slug($request->input('name'))
        // ]);
        return response(new CategoryResource($category),Response::HTTP_ACCEPTED);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
