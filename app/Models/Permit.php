<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;
     protected $fillable = [
        'permit_num',
        'warehouse',
        'cost_type',
        'type',
        'client',
        'custom',
        'contractor',
        'driver',
        'car_no',
        'employee',
        'car_no2',
        'quantity',
        'cost'
    ];

    public function warehouses()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse', 'id');
    }

       public function clients()
    {
        return $this->belongsTo(Client::class, 'client', 'id');
    }
        public function types()
    {
        return $this->belongsTo(Type::class, 'type', 'id');
    }
}
