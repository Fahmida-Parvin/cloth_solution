<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LaundryRequest extends Model
{
    protected $fillable = ['name', 'address', 'mobile', 'delivery_date', 'status'];
    // Add other fields as needed

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
