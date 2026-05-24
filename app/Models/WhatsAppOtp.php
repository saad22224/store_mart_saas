<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppOtp extends Model
{
    use HasFactory;
protected $table= 'whatsapp_otps';
    protected $fillable = [
        'mobile',
        'otp',
        'expires_at',
        'is_verified',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * Check if the OTP is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
