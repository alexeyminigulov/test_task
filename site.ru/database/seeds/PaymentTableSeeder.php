<?php

use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment')->insert([
            ['premium' => 3000, 
            'salary' => 40000, 
            'date' => '2017-05-02', 
            'worker_id' => 1],

            ['premium' => 2000, 
            'salary' => 30000, 
            'date' => '2017-05-02', 
            'worker_id' => 2],

            ['premium' => 3000, 
            'salary' => 42000, 
            'date' => '2017-06-02', 
            'worker_id' => 3],

            ['premium' => 5000, 
            'salary' => 35000, 
            'date' => '2017-06-02', 
            'worker_id' => 4],

            ['premium' => 5000, 
            'salary' => 25000, 
            'date' => '2017-07-02', 
            'worker_id' => 4],
        ]);
    }
}
