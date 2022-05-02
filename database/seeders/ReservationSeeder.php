<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            [
                'start' => '2022-04-22',
                'end' => '2022-04-28',
                'name' => 'Emely',
                'surname' => 'Roth',
                'email' => 'emely@roth.com',
                'phone' => '+42112356789',
                'adult_count' => 2,
                'child_count' => 1,
                'pet' => 1
            ],
            [
                'start' => '2022-04-30',
                'end' => '2022-05-01',
                'name' => 'Myah',
                'surname' => 'Melton',
                'email' => 'Myah@Melton.com',
                'phone' => '+42112374589',
                'adult_count' => 1,
                'child_count' => 0,
                'pet' => 0
            ],
            [
                'start' => '2022-05-01',
                'end' => '2022-05-06',
                'name' => 'Arielle',
                'surname' => 'Larson',
                'email' => 'Arielle@Larson.com',
                'phone' => '+422123745589',
                'adult_count' => 4,
                'child_count' => 0,
                'pet' => 1
            ],
            [
                'start' => '2022-05-06',
                'end' => '2022-05-15',
                'name' => 'Emma',
                'surname' => 'Oconnor',
                'email' => 'Emma@Oconnor.com',
                'phone' => '+42112377839',
                'adult_count' => 2,
                'child_count' => 2,
                'pet' => 0
            ],
            [
                'start' => '2022-05-17',
                'end' => '2022-05-25',
                'name' => 'Leilani',
                'surname' => 'Woodward',
                'email' => 'Leilani@Woodward.com',
                'phone' => '+421124766389',
                'adult_count' => 3,
                'child_count' => 0,
                'pet' => 0
            ],
            [
                'start' => '2022-05-25',
                'end' => '2022-06-02',
                'name' => 'Andreas',
                'surname' => 'Berry',
                'email' => 'Andreas@Berry.com',
                'phone' => '+42112363589',
                'adult_count' => 4,
                'child_count' => 2,
                'pet' => 1
            ],
        ]);
    }
}
