<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(ProductFilter $filter)
    {
        $products = Product::filter($filter)->get();

        return response(ProductResource::collection($products));
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Product::generateSlug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price
        ]);

        return response(new ProductResource($product), Response::HTTP_CREATED);
    }

    public function show($param)
    {
        if (is_numeric($param)) {
            return new ProductResource(Product::where('id', $param)->first());
        } else {
            return new ProductResource(Product::where('slug', $param)->firstOrFail());
        }
    }
}
