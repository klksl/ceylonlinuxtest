<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderSku extends Model
{
    use HasFactory;

    protected $table='purchase_order_skus';

    protected $primaryKey = 'purchase_order_sku_id';

    protected $fillable = [
        'quantity',
        'price',
        'sku_id',
        'purchase_order_id',
    ];
}
