<?php namespace Sunnyr\Company\Http\Controllers\Brands;

use Sunnyr\Company\Http\Controllers\Controller;
use Sunnyr\Company\Http\Services\BrandService;

class BrandController extends Controller
{
    public $brandService;
    
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function details($ids)
    {
        return $this->brandService->details($ids);
    }
}
