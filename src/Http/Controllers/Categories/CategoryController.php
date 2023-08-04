<?php namespace Sunnyr\Company\Http\Controllers\Categories;

use Inertia\Inertia;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Request;
use Sunnyr\Company\Http\Controllers\Controller;
use Sunnyr\Company\Http\Services\ProductService;
use Sunnyr\Company\Http\Services\CategoryService;

class CategoryController extends Controller
{
    public $categoryService;
    
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function details($ids)
    {
        return $this->categoryService->details($ids);
    }
}
