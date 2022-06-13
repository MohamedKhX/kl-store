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
           'name'  => 'زوارة / الجميل',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'زلطن / رقدالين',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'ترهونة',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'بني وليد / سبها',
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
           'name'  => 'توكرة / قمينس',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'اجدابيا / المرج',
           'price' => 30
        ]);

        City::factory()->create([
           'name'  => 'البيضاء / شحات',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'القبة / درنة / طبرؤ',
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
           'name'  => 'القربولي / الخمس',
           'price' => 20
        ]);

        City::factory()->create([
           'name'  => 'مصراته / زليتن',
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
           'name'  => 'غريان / الأصابعة',
           'price' => 25
        ]);

        City::factory()->create([
           'name'  => 'يفرن / القلعة',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'القواليش / ككلة',
           'price' => 35
        ]);

        City::factory()->create([
           'name'  => 'الريانة / الزنتان',
           'price' => 40
        ]);

        City::factory()->create([
           'name'  => 'جادو / الرجبان / الرحيبات',
           'price' => 50
        ]);
    }
}
