<?php

use App\{User, Profession};
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professionId = Profession::where('title', 'Desarrollador back-end')->value('id');

        User::create([
            'name' => 'Cristyan Valera',
            'email' => 'cristyan12@mail.com',
            'password' => bcrypt('123'),
            'profession_id' => $professionId,
        ]);
    }
}
