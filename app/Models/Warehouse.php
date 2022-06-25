<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'capacity',
        'size',
        'loacation'
    ];

      public function permits()
    {
        return $this->hasMany(Permit::class, 'warehouse', 'id');
    }

    
}