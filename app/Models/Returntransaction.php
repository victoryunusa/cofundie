<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returntransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'amount',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
