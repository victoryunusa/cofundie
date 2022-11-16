<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'invest_type',
        'min_invest',
        'max_invest',
        'max_invest',
        'capital_back',
        'is_period',
        'period_duration',
        'profit_range',
        'loss_range',
        'thumbnail',
        'preview',
        'address',
        'status',
        'max_invest_amount',
        'accept_new_investor',
        'accept_installments',
    ];

    public function meta()
    {
        return $this->hasOne(Projectmeta::class);
    }

    public function installment()
    {
        return $this->hasOne(Projectmeta::class)->where('key', 'installments');
    }

    public function schedule()
    {
        return $this->hasOne(Returnschedule::class)->where('return_date', today());
    }

    public function nextschedule()
    {
        return $this->hasOne(Returnschedule::class)->where('return_date', '>=', today())->whereStatus(0);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class)->where('is_returnable', 1);
    }

    public function is_installment()
    {
        return $this->hasOne(Installment::class);
    }
}
