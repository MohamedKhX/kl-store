<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::factory()->create([
           'name'  => 'وسط طرابلس',
           'price' => 10
        ]);

        City::factory()->create([
           'name'  => 'ضواحي طرابلس',
           'price' => 20
        ]);

        City::factory()->create([
           'name'  => 'الزاية',
           'price' => 20
        ]);

        City::factory()->create([
           'name'  => 'صرمان',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'صبراته',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'العجيلات',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'الجميل',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'زوارة',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'زلطن',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'رقدالين',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'ترهونة',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'بني وليد',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'سبها',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'الجفرة (هون, سوكنة, ودان)',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'براك الشاطى',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'أوباري',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'بنغازي',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'توكرة',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'قمينس',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'المرج',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'اجدابيا',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'البيضاء',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'شحات',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'القبة',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'طبرؤ',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'درنة',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'جالو اوجلة',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'الأبيار',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'الخمس',
           'price' => 20
        ]);

        City::factory()->create([
           'name'  => 'القربولي',
           'price' => 20
        ]);

        City::factory()->create([
           'name'  => 'زليتن',
           'price' => 20
        ]);

        City::factory()->create([
           'name'  => 'مصراته',
           'price' => 20
        ]);

        City::factory()->create([
           'name'  => 'مسلاته',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'سرت',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'البريقة',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'الأصابعة',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'غريان',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'القلعة',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'يفرن',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'ككلة',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'القواليش',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'الريانة',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'الزنتان',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'الرحيبات',
           'price' => 50
        ]);

        City::factory()->create([
           'name'  => 'الرجبان',
           'price' => 50
        ]);

        City::factory()->create([
           'name'  => 'جادو',
           'price' => 50
        ]);
    }
}
