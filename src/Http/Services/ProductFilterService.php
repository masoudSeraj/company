<?php namespace Sunnyr\Company\Http\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Sunnyr\Company\Http\Resources\ProductResource;

class ProductFilterService
{
    public function getProducts(Request $request)
    {
        return ProductResource::collection( 
                Product::query()
                    ->whereHas('reservationAvailable', function($query){
                        $query->where('reservability', 'reservable');
                    })
                    ->when($request->filled('search'), fn($query) => $query->where('products.title','LIKE','%'.$request->search.'%'))
                    ->when($request->filled('sort'), fn($query)  => $query->orderBy('title', $request->sort))

                    ->when($request->filled('checkSelection'), fn($query) => $query->whereHas('categories', fn($builder) => $builder
                        ->whereIn('categories.id', explode(',', $request->checkSelection))
                    ))
                    ->when($request->filled('checkSelectionBrand'), fn($query) => $query->whereHas('brand', fn($builder) => $builder
                        ->whereIn('brands.id', explode(',', $request->checkSelectionBrand))
                    ))

                    // ->when($request->filled('checkSelection'), function($query) use($request){
                    //     $conditions = collect(explode(',', $request->checkSelection))->map(fn($check) => ['categories.id' => $check]);

                    //     // dd($conditions->toArray());
                    //     return $query->whereHas('categories', fn($builder) => $builder->where($conditions));
                    // })

                    // ->when($request->filled('checkSelection'), fn($query) => $query->whereHas('categories', fn($builder) => $builder
                    //     ->where(function() use($request){
                    //         return collect(explode(',', $request->checkSelection))->map(function($check){
                    //             return ['categories.id' => $check];
                    //         });
                    //     })
                    // ))
                ->paginate(15)
                ->withQueryString()
        );
    }
}

