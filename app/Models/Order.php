<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function vendorinfo()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id', 'name');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
