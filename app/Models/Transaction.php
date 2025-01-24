<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 'Pending':
                return [
                    'label' => 'Pending',
                    'color' => "orange",
                ];
            case 'Paid':
                return [
                    'label' => "Paid",
                    'color' => "#0000ff",
                ];
            case 'Cancelled':
                return [
                    'label' => 'Canceled',
                    'color' => "#cd5c5c",
                ];
         
            default:
                return [
                    'label' => 'Pending',
                    'color' => "orange",
                ];
        }
    }
}
