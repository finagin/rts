<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Skill::class, function (Faker $faker) {
    $chars = preg_split('//u', 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ', -1, PREG_SPLIT_NO_EMPTY);

    return [
        'slug' => implode($faker->randomElements($chars, random_int(1, 3))),
        'description' => $faker->text(),
    ];
});
