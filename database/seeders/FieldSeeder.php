<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fields')->insert([
            [
                'name' => 'subTitle',
                'value' => 'Nějaký popisek'
            ],
            [
                'name' => 'alertTitle',
                'value ' => 'Upozornění!'
            ],
            [
                'name' => 'alertText',
                'value' => 'Kdyby se cokoli stalo, nebo nějaká důležitá informace pro uživatele. Mohlo by se zobrazovat toto okýnkdo, kde bude možné napsat cokoli. Pokud bude vše v pořádku vůbec tady to okénko viditelné být nemusí.'
            ],
            [
                'name' => 'infoTitle',
                'value' => 'Chata Travná'
            ],
            [
                'name' => 'infoText',
                'value' => 'Nějaký pěkný popisek chaty. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam in lorem sit amet leo accumsan lacinia. Duis risus. Etiam neque. Aliquam ornare wisi eu metus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Vivamus porttitor turpis ac leo. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Fusce suscipit libero eget elit.'
            ],
            [
                'name' => 'phone',
                'value' => '721 892 661'
            ],
            [
                'name' => 'email',
                'value' => 'j.svardala@seznam.cz'
            ],
            [
                'name' => 'address',
                'value' => 'Lipovská 1170, Jeseník 790 01'
            ]
        ]);
    }
}
