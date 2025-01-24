<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodcat extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function childrens()
    {
        return $this->hasMany(Prodcat::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Prodcat::class, 'parent_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

 

    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'filter_prodcats');
    }

    public function allChildCategories()
    {
        return $this->children()->with('allChildCategories');
    }
    public function allParentCategories()
    {
        return $this->parent()->with('allParentCategories');
    }
}
