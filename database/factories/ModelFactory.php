<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Entities\Workflow::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Entities\WorkflowNode::class, function (Faker\Generator $facker) {
    return [
        'order' => $facker->numberBetween(1,10),
        'title' => $facker->title
    ];
});
