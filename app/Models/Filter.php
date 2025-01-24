<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;


    public function values(): Attribute
    {
        return Attribute::make(
            set: fn($value) => json_encode(explode(',', $value)),
            get: fn($value) => $value ? implode(',', json_decode($value, true)) : ''
        );
    }

    public function getValue()
    {
        return json_decode($this->attributes['values'], true);
    }
}
