<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Status::class, function (Faker $faker) {
     //随机生成时间
    $date_time = $faker->date . ' ' . $faker->time;


    return [
        'content'    => $faker->text(),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
