<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;
    protected $fillable = [
        'custom',
        'type',
        'client',
        'balance',
        'vessel',
        'date'
    ];
      
      public function types()
    {
        return $this->belongsTo(Type::class, 'type', 'id');
    }

       public function clients()
    {
        return $this->belongsTo(Client::class, 'client', 'id');
    }
}
