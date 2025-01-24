<?php

namespace App\Services;

use App\Models\Prodcat;
use Illuminate\Support\Facades\Cache;

class DependencyVariables
{

    public static function getCategoryTree($parentId = null)
    {
        if ($parentId == null) {
            $categories = Prodcat::has('childrens')->with('childrens')->where('parent_id', $parentId)->get();
        } else {

            $categories = Prodcat::where('parent_id', $parentId)->with('childrens')->get();
        }


        foreach ($categories as $category) {
            $category->childrens = self::getCategoryTree($category->id);
        }

        return $categories;
    }
    public static function categories()
    {

        
        $categories = Cache::remember('main_categories_asdasdasd', 3600, function () {
            return self::getCategoryTree();
        });

       


        return $categories;
    }
}
