<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use TCG\Voyager\Facades\Voyager;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::where('shop_id',auth()->user()->shop->id)->latest()->get();
    }

    public function map($product): array
    {
        // dd($product->prodcats);
        $images=[];
        $categories=[];
        if(isset($product->images)){

            foreach(json_decode($product->images) as $image){
                $images[]=Voyager::image($image);
            }
            $imagesString = implode(',', $images); 
        }else{
            $imagesString=null;
        }
        if(isset($product->prodcats)){
             foreach($product->prodcats as $category){
                $categories[]=$category->id;
             }
             $categoryString=implode(',', $categories);
        }else{
            $categoryString=null;
        }
       
        

        
        return [
            $product->name,
            $product->description,
            $product->price,
            $product->sale_price,
            Voyager::image($product->image),
            $product->quantity,
            $product->sku,
            $product->status,
            $imagesString,
            $product->short_description,
            $product->weight,
            $product->dimensions,
            $categoryString,
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'description',
            'price',
            'saleprice',
            'image',
            'quantity',
            'sku',
            'status',
            'images',
            'short_description',
            'weight',
            'dimension',
            'category_id',
        ];
    }
}
