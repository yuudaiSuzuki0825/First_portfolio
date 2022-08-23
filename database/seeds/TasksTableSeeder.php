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
                'title' => 'test' . $i,
                'start' => 'test' . $i,
                'end' => 'test' . $i,
                'content' => 'test' . $i
            ]);
        }
    }
}
