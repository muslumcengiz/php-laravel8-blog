<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //3 gün önce yayınlanmış blog yazısı
        DB::table('posts')->insert([
            'title' => '3 Gün önce yayına girdim.',
            'slug' => Str::slug('3 Gün önce yayına girdim.'),
            'content' => $faker->realText(2000),
            //'image' => $faker->imageUrl(),
            'publish_date' => date('Y-m-d H:i:s', strtotime('-3 day', time())),
            'user' => rand(1, 2),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //3 Gün sonra yayınlanacak
        DB::table('posts')->insert([
            'title' => 'Yayına girmem için 3 gün daha beklemeliyim',
            'slug' => Str::slug('Yayına girmem için 3 gün daha beklemeliyim'),
            'content' => $faker->realText(2000),
            //'image' => $faker->imageUrl(),
            'publish_date' => date('Y-m-d H:i:s', strtotime('3 day', time())),
            'user' => rand(1, 2),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //Rastgele 100 adet blog yazısı
        for ($i = 0; $i < 100; $i++) {
            $title=$faker->text();
            $updated_at=$faker->dateTime(strtotime('-1 day', time()));
            DB::table('posts')->insert([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => $faker->realText(2000),
                //'image' => $faker->imageUrl(640,480,'cats', true, 'Faker', true),
                'publish_date' => null,
                'user' => rand(1, 2),
                'created_at' => $faker->dateTime($updated_at),
                'updated_at' => $updated_at
            ]);
        }
    }
}
