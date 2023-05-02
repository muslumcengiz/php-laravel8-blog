<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CommentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();

        for ($i = 0; $i < 200; $i++) {
            $updated_at=$faker->dateTime(strtotime('-1 day', time()));
            DB::table('comments')->insert([
                'post' => rand(1,102),
                'content' => $faker->text(),
                'user' => rand(1, 2),
                'created_at' => $faker->dateTime($updated_at),
                'updated_at' => $updated_at
            ]);
        }
    }
}
