<?php

use Illuminate\Database\Seeder;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workers')->insert([
            [
                'first_name' => 'Генадий',
                'last_name' => 'Андреев',
                'salary' => 21000,
                'profession_id' => 1,
                'photo' => {"min": "1499427132_min.jpg", "medium": "1499427132_medium.jpg"},
            ],
            [
                'first_name' => 'Петр',
                'last_name' => 'Кузнецов',
                'salary' => 26000,
                'profession_id' => 2,
                'photo' => {"min": "1499427314_min.jpg", "medium": "1499427314_medium.jpg"},               
            ],
            [
                'first_name' => 'Николай',
                'last_name' => 'Егоров',
                'salary' => 25000,
                'profession_id' => 3,
                'photo' => {"min": "1499427330_min.jpg", "medium": "1499427330_medium.jpg"},               
            ],
            [
                'first_name' => 'Алексей',
                'last_name' => 'Некрасов',
                'salary' => 27000,
                'profession_id' => 1,
                'photo' => {"min": "1499427349_min.jpg", "medium": "1499427349_medium.jpg"},               
            ],
            [
                'first_name' => 'Александр',
                'last_name' => 'Голиков',
                'salary' => 36600,
                'profession_id' => 2,
                'photo' => {"min": "1499427418_min.jpg", "medium": "1499427418_medium.jpg"},               
            ],
            [
                'first_name' => 'Антон',
                'last_name' => 'Сидоров',
                'salary' => 25000,
                'profession_id' => 3,
                'photo' => {"min": "1499427438_min.jpg", "medium": "1499427438_medium.jpg"},              
            ],

            
            [
                'first_name' => 'Алена',
                'last_name' => 'Филипова',
                'salary' => 29000,
                'profession_id' => 1,
                'photo' => {"min": "1499427456_min.jpg", "medium": "1499427456_medium.jpg"},                
            ],
            [
                'first_name' => 'Анна',
                'last_name' => 'Курнишова',
                'salary' => 16800,
                'profession_id' => 2
            ],
            [
                'first_name' => 'Альбина',
                'last_name' => 'Сабитовна',
                'salary' => 45000,
                'profession_id' => 3
            ],
            [
                'first_name' => 'Ксения',
                'last_name' => 'Пермякова',
                'salary' => 37000,
                'profession_id' => 1
            ],
            [
                'first_name' => 'Анастасия',
                'last_name' => 'Волкова',
                'salary' => 23000,
                'profession_id' => 2
            ],
            [
                'first_name' => 'Елена',
                'last_name' => 'Сидоровна',
                'salary' => 33000,
                'profession_id' => 3
            ],

            [
                'first_name' => 'Жанна',
                'last_name' => 'Одинцова',
                'salary' => 17000,
                'profession_id' => 1
            ],
            [
                'first_name' => 'Анжела',
                'last_name' => 'Якубова',
                'salary' => 20500,
                'profession_id' => 2
            ],
            [
                'first_name' => 'Елена',
                'last_name' => 'Егоровна',
                'salary' => 28500,
                'profession_id' => 3
            ],
        ]);
    }
}
