<?php

use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'name' => str_random(10),
            'term' => str_random(10).'@gmail.com',
            'lecturer_id' => 1,
        ]);
    }
}
