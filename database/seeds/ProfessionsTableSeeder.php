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

        factory(Profession::class)->create([
            'title' => 'Cajero integral'
        ]);

        factory(Profession::class)->create([
            'title' => 'Ejecutivo de servicios'
        ]);

        factory(Profession::class)->create([
            'title' => 'Tesorero'
        ]);

        factory(Profession::class)->create([
            'title' => 'Supervisor de oficina'
        ]);

        factory(Profession::class)->create([
            'title' => 'Sub-Gerente de oficina'
        ]);

        factory(Profession::class)->create([
            'title' => 'Gerente de oficina'
        ]);

        factory(Profession::class, 7)->create();
    }
}
