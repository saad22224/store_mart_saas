<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'whatsapp_number',
        'delivery_duration',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function vendors()
    {
        return $this->belongsToMany(User::class, 'shipping_company_vendor', 'shipping_company_id', 'vendor_id')
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
