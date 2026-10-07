<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemContentSection extends Model
{
    use HasFactory;

    protected $table = 'item_content_sections';

    protected $fillable = [
        'vendor_id',
        'item_id',
        'section_type',
        'title',
        'body',
        'media',
        'meta',
        'reorder_id',
        'is_active',
    ];

    protected $casts = [
        'media' => 'array',
        'meta' => 'array',
        'is_active' => 'integer',
        'reorder_id' => 'integer',
    ];

    /** Known section types for the admin UI; rendering falls back gracefully for unknown types. */
    public const SECTION_TYPES = [
        'benefits',
        'rich_text',
        'image',
        'image_text',
        'features',
        'specifications',
        'faq',
        'video',
        'trust',
        'cta',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeForVendorItem($query, $vendorId, $itemId)
    {
        return $query->where('vendor_id', $vendorId)->where('item_id', $itemId);
    }
}
