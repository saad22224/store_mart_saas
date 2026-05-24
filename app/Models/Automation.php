<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'trigger_type', // e.g., 'after_registration', 'inactive_user', 'store_created', 'first_sale'
        'delay_in_hours',
        'message',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function logs()
    {
        return $this->hasMany(AutomationLog::class);
    }
}
