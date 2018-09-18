<?php

use App\Profession;
use Illuminate\Database\Seeder;

class ProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Profession::class)->create([
            'title' => 'Desarrollador back-end'
        ]);

        factory(Profession::class)->create([
            'title' => 'Desarrollador front-end'
        ]);

        factory(Profession::class)->create([
            'title' => 'Diseñador web'
        ]);

        factory(Profession::class, 7)->create();
    }
}
