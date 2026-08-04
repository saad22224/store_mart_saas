<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theme;
use App\Models\VendorTheme;
use App\Models\SystemAddons;

class AddTemplatesSeeder extends Seeder
{
    public function run()
    {
        $themeList = [
            [
                'id' => 17,
                'name' => 'Fashion & Clothes Theme',
                'identifier' => 'theme_17',
                'image' => 'theme-17.png',
                'preview_link' => '#',
            ],
            [
                'id' => 18,
                'name' => 'Jewelry & Accessories Theme',
                'identifier' => 'theme_18',
                'image' => 'theme-18.png',
                'preview_link' => '#',
            ],
            [
                'id' => 19,
                'name' => 'Beauty & Perfumes Theme',
                'identifier' => 'theme_19',
                'image' => 'theme-19.png',
                'preview_link' => '#',
            ],
            [
                'id' => 20,
                'name' => 'Bags & Fashion Theme',
                'identifier' => 'theme_20',
                'image' => 'theme-20.png',
                'preview_link' => '#',
            ],
            [
                'id' => 21,
                'name' => 'Books & Stationery Theme',
                'identifier' => 'theme_21',
                'image' => 'theme-21.png',
                'preview_link' => '#',
            ],
        ];

        foreach ($themeList as $item) {
            // Update or Create SystemAddons
            SystemAddons::updateOrCreate(
                ['unique_identifier' => $item['identifier']],
                [
                    'name' => $item['name'],
                    'version' => '1.0',
                    'activated' => 1,
                    'image' => $item['image'],
                ]
            );

            // Update or Create VendorTheme
            VendorTheme::updateOrCreate(
                ['reorder_id' => $item['id']],
                [
                    'name' => $item['name'],
                    'image' => $item['image'],
                    'preview_link' => $item['preview_link'],
                    'is_active' => 1,
                ]
            );

            // Update or Create Theme
            Theme::updateOrCreate(
                ['id' => $item['id']],
                [
                    'reorder_id' => $item['id'],
                    'vendor_id' => 1,
                    'name' => $item['name'],
                    'image' => $item['image'],
                ]
            );
        }
    }
}
