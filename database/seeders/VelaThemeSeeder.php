<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Theme;

class VelaThemeSeeder extends Seeder
{
    public function run()
    {
        $themeExists = Theme::where('name', 'Vela Theme')->first();
        if (!$themeExists) {
            Theme::insert([
                'name' => 'Vela Theme',
                'vendor_id' => 1,
                'image' => 'theme-17.png',
            ]);
        }
    }
}
