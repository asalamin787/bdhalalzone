<?php

namespace App\Models;

use App\Events\ChargeStatusHasBeenUpdated;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Charge extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function chargeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }
    public function paymentDetails(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value)
        );
    }

    public function success()
    {
        $this->status = 'Paid';
        $this->save();
        ChargeStatusHasBeenUpdated::dispatch($this);
        return $this;
    }

    public function canceled()
    {
        $this->status = 'Cancelled';
        $this->save();
        ChargeStatusHasBeenUpdated::dispatch($this);
        return $this;
    }
    public function failed()
    {
        $this->status = 'Failed';
        $this->save();
        ChargeStatusHasBeenUpdated::dispatch($this);
        return $this;
    }
}
