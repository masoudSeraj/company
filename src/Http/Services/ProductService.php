<?php namespace Sunnyr\Company\Http\Services;

use App\Models\Product;
use Sunnyr\Company\Http\Resources\ProductResource;

class ProductService
{
    public function randomProducts()
    {
        return ProductResource::collection(Product::inRandomOrder()->get()->take(10));
    }

    public function show($productId)
    {
        return new ProductResource(Product::find($productId));
    }
}

