<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;

    protected $table='skus';

    protected $primaryKey = 'sku_id';

    protected $fillable = [
        'sku_code',
        'sku_name',
        'mrp',
        'distributor_price',
        'weight_volume',
        'weight_unit'
    ];
}
