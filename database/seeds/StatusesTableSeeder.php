<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //只对前三个ID插入微博数据
        $user_ids = ['1','2','3'];

        $faker = app(Faker\Generator::class);

        $statuses = factory(App\Models\Status::class)->times(100)->make()->each(function ($status) use ($faker, $user_ids) {
            $status->user_id = $faker->randomElement($user_ids);
        });

        App\Models\Status::insert($statuses->toArray());
    }
}
