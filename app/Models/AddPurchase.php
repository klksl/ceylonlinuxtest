<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPurchase extends Model
{
    use HasFactory;

    protected $table='purchases';


    protected $fillable = [
        'sku_code',
        'sku_name',
        'unit_price',
        'avb_qty',
        'enter_qty',
        'units',
        'total_price'
    ];

    public function zone(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
    public function territories(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Territory::class, 'zone_id');
    }
    public function regions(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class, 'zone_id');
    }
}
