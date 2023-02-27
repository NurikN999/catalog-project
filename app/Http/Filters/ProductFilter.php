<?php

namespace App\Http\Filters;

use App\Models\Category;

class ProductFilter extends QueryFilter
{
    /**
     * @param string $categoryName
     */
    public function category(string $categoryName)
    {
        $category = Category::where('name', $categoryName)->first();
        $this->builder->where('category_id', strtolower($category->id));
    }

    /**
     * @param int $price
     */
    public function price(int $price)
    {
        $this->builder->where('price', $price);
    }

}
