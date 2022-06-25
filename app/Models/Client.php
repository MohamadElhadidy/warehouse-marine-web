<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'address',
        'tele',
        'email'
    ];
      public function goods()
    {
        return $this->hasMany(Goods::class, 'client', 'id');
    }
        public function permits()
    {
        return $this->hasMany(Permit::class, 'client', 'id');
    }
}
