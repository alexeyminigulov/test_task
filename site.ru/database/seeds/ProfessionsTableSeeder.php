<?php

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
        DB::table('professions')->insert([
            ['name' => 'бухгалтер'],
            ['name' => 'курьер'],
            ['name' => 'менеджер']
        ]);
    }
}
