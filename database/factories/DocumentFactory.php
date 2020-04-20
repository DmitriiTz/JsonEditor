<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Document;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Document::class, function (Faker $faker) {
    $status = ['draft', 'published'];
    $type = ['quick', 'middle', 'slow'];
    $payload = [
        'actor' => $faker->name,
        'meta' => [
            'type' => $faker->randomElement($type),
            'color' => $faker->colorName
        ],
        'actions' => [
            'action' => $faker->sentence(2),
            'actor' => $faker->name
        ]
    ];
    return [
        'status' => $faker->randomElement($status),
        'payload' => json_encode($payload)
    ];
});
