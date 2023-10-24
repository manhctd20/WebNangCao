<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function travelPackages()
    {
        return $this->belongsTo(TravelPackage::class);
    }
}
