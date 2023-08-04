<?php namespace Sunnyr\Company\Http\Controllers\Products;

use Inertia\Inertia;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Request;
use Sunnyr\Company\Http\Controllers\Controller;
use Sunnyr\Company\Http\Services\ProductService;

class ProductController extends Controller
{
    public $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    public function random()
    {
        return $this->productService->randomProducts();
    }

    public function show($id)
    {
        return Inertia::render('ProductFilter/Show', [
            'product' => $this->productService->show($id)
        ]);
    }
}
