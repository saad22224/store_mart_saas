<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landing2Translation extends Model
{
    use HasFactory;

    protected $fillable = ['section', 'field', 'lang', 'value'];

    public $timestamps = true;

    /**
     * Get translation value
     */
    public static function get($section, $field, $lang = 'ar')
    {
        $translation = self::where('section', $section)
            ->where('field', $field)
            ->where('lang', $lang)
            ->first();
        
        return $translation ? $translation->value : null;
    }

    /**
     * Set translation value
     */
    public static function set($section, $field, $lang, $value)
    {
        return self::updateOrCreate(
            ['section' => $section, 'field' => $field, 'lang' => $lang],
            ['value' => $value]
        );
    }

    /**
     * Get all translations for a section
     */
    public static function getSection($section, $lang = 'ar')
    {
        $translations = self::where('section', $section)
            ->where('lang', $lang)
            ->pluck('value', 'field')
            ->toArray();
        
        return $translations;
    }

    /**
     * Get all translations as array grouped by section
     */
    public static function getAll($lang = 'ar')
    {
        $translations = self::where('lang', $lang)
            ->get()
            ->groupBy('section')
            ->map(function($items) {
                return $items->pluck('value', 'field')->toArray();
            })
            ->toArray();
        
        return $translations;
    }
}
