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

    public function getCategories($parent_id = null)
    {
        $categories = Category::where('parent_id', $parent_id)->get();
        $result = [];

        foreach ($categories as $category) {
            $children = $this->getCategories($category->id); // Рекурсивный вызов для получения дочерних категорий
            $result[] = [
                'id' => $category->id,
                'name' => $category->name,
                'children' => $children
            ];
        }

        return $result;
    }

    public function getChilds(Request $request) {
        $categories = Category::where('parent_id', $request->id)->get();
        return response()->json(CategoryResource::collection($categories));
    }
}
