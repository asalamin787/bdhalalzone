<?php

namespace App\Services;

use App\Models\Prodcat;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;     

class ProductImportService
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }
    public  function import()
    {
     

   
        $uniqueId = substr(Str::uuid()->toString(8), 0, 10);
        $slug = Str::slug($this->data['product_name']) . '-' . $uniqueId;
        $product= Product::updateOrCreate(
            [
                'sku' => $this->data['sku']
            ],
            [
                'shop_id' => auth()->user()->shop->id,
                'name' => $this->data['name'],
                
                'quantity' => $this->data['quantity'],
                'sku' => $this->data['sku'],
                'description' => $this->data['description'],
                'slug' => $slug,
                'price' => $this->data['price'],
                'sale_price' => $this->data['saleprice'],
                'status' => $this->data['status'],
                'short_description' => $this->data['short_description'],
                'weight' => $this->data['weight'],
                'dimensions' => $this->data['dimension'],
                'image' => self::getImage(),
                'images' => json_encode(self::getImages()),
            ]
        );
        $isProductNew = !$product->wasRecentlyCreated;
       self::category($product,$isProductNew);
    }
    private function getImage()  {
        $imageContents = file_get_contents($this->data['image']);
        if ($imageContents === false) {
            return response()->json(['error' => 'Failed to download image'], 500);
        }
        $imageName = Str::random(10) . '.jpg';
        $path = 'products/' . $imageName;
        Storage::put($path, $imageContents);
        // dd($imageName);
        return $path;
    }
    private function getImages()  {
        $images=$this->data['images'];
        $data=[];
        if(isset($images)){
            $urlsArray = explode(',', $images);
            foreach( $urlsArray as $image){
                $imageContents = file_get_contents($this->data['image']);
                if ($imageContents === false) {
                    return response()->json(['error' => 'Failed to download image'], 500);
                }
                $imageName = Str::random(10) . '.jpg';
                $path = 'products/' . $imageName;
                Storage::put($path, $imageContents);
                // dd($imageName);
                $data[]=$path;
              
            }
            return $data;
        }else{
            return null;
        }
        
    }
    private function category($product,$isProductNew)  {
        $category_ids=$this->data['category_id'];
        if(isset($category_ids)){
            $categoriesArray = explode(',', $category_ids);
            // if ($isProductNew) {
            //     return $product->prodcats()->attach($categoriesArray);
            // } else {
                return $product->prodcats()->sync($categoriesArray);
            // }
           
        }
    }
}
