<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table='purchase_orders';

    protected $primaryKey = 'purchase_order_id';

    protected $fillable = [
        'zone_id',
        'region_id',
        'territory_id',
        'distributor_id',
        'purchase_date',
        'purchase_no',
        'total_amount',
        'remark',
    ];
}
