<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'instagram_post_id',
        'item_id',
        'username',
        'media_url',
        'caption',
    ];
}
