<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code'
    ];
      public function goods()
    {
        return $this->hasMany(Goods::class, 'type', 'id');
    }
       public function permits()
    {
        return $this->hasMany(Permit::class, 'type', 'id');
    }
}
