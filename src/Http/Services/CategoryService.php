<?php namespace Sunnyr\Company\Http\Services;

use App\Models\Category;
use Sunnyr\Company\Http\Resources\CategoryResource;

class CategoryService
{
    public function getParentCategories()
    {
        return 
                Category::whereNull('category_id')->where('type', 'productcat')->get()->map(function($category){
                    return [
                        'id'    =>  $category->id,
                        'parent'  => $category->title,
                        'children' => CategoryResource::collection(Category::find($category->id)->categories),
                    ];
                });            
    }

    public function details($categoryIds)
    {        
        return CategoryResource::collection(Category::whereIn('id', explode(',', $categoryIds))->get());
    }
}

