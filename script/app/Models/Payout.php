<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'amount',
        'charge',
        'user_id',
        'commant',
        'currency',
        'payout_method_id',
    ];

    public function payout_method()
    {
        return $this->belongsTo(PayoutMethod::class);
    }
}
