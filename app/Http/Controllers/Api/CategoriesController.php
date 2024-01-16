<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;

class CategoriesController extends BaseController
{
    public function index(Request $request)
    {
        return Category::all();
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        Category::create($data);
        return response()->json(['success' => true], 201);
    }

    public function update(StoreCategoryRequest $request, Category $obj)
    {
        $data = $request->validated();
        $obj->update($data);
        return response()->json(['success' => true], 201);
    }

    public function destroy(Category $obj)
    {
        $obj->delete();
        return response()->json(['success' => true], 200);
    }
}
