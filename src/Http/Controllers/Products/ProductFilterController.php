<?php namespace Sunnyr\Company\Http\Controllers\Products;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Sunnyr\Company\Http\Services\BrandService;
use Sunnyr\Company\Http\Controllers\Controller;
use Sunnyr\Company\Http\Services\CategoryService;
use Sunnyr\Company\Http\Services\ProductFilterService;

class ProductFilterController extends Controller
{
    
    public function __construct(
        public ProductFilterService $productFilterService,
        public CategoryService $categoryService,
        public BrandService $brandService)
    {
    }
    
    public function filter(Request $request)
    {
        return Inertia::render('ProductFilter/Index', [
            'products'      =>  $this->productFilterService->getProducts($request),
            'categories'    =>  $this->categoryService->getParentCategories(),
            'brands'        =>  $this->brandService->getBrands()
        ]);
    }
}
