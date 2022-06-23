<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table='zones';

    protected $primaryKey = 'zone_id';

    protected $fillable = [
        'long_description',
        'short_description'
    ];

    public function regions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Region::class, 'zone_id');
    }

    public function territories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Territory::class, 'zone_id');
    }
}
