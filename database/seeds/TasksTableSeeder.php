<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('tasks')->insert([
                'title' => Str::random(10),
                'start' => "2022-11-28",
                'end' => "2022-12-31",
                'content' => Str::random(100),
            ]);
        }
    }
}
