<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfessionsTableSeeder::class);
        $this->call(WorkersTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
    }
}
