<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json(CategoryResource::collection($categories));
    }

    public function getChilds(Request $request) {
        $categories = Category::where('parent_id', $request->id)->get();
        return response()->json(CategoryResource::collection($categories));
    }
}
