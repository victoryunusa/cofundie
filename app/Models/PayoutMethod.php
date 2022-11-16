<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'min_limit',
        'max_limit',
        'delay',
        'fixed_charge',
        'rate',
        'percent_charge',
        'currency',
        'data',
        'instruction',
        'status',
        'image',
    ];

    public function usermethod()
    {
        return $this->hasOne(UserPayoutMethod::class)->where('user_id', auth()->id());
    }
}
