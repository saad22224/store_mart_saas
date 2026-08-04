<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorTheme extends Model
{
    use HasFactory;

    protected $table = 'vendor_themes';

    protected $fillable = [
        'name',
        'image',
        'preview_link',
        'reorder_id',
        'is_active',
    ];
}
