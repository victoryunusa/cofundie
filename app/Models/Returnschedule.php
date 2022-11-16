<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returnschedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'project_id',
        'return_type',
        'profit_type',
        'attachment',
        'return_date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
