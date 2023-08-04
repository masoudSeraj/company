<?php namespace Sunnyr\Company\Http\Services;

use App\Models\Brand;
use Sunnyr\Company\Http\Resources\BrandResource;

class BrandService
{
    public function getBrands()
    {
        return BrandResource::collection(Brand::all());         
    }

    public function details($brandIds)
    {
        return BrandResource::collection(Brand::whereIn('id', explode(',', $brandIds))->get());

    }
}

