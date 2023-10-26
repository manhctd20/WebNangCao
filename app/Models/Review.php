<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'travel_package_id', 'rating', 'comment',
    ];
    
    public $timestamps = true;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function travelPackages()
    {
        return $this->belongsTo(TravelPackage::class);
    }
}
