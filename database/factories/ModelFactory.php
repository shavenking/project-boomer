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

$factory->define(App\Entities\MainflowType::class, function (Faker\Generator $facker) {
    return [
        'name' => $facker->name
    ];
});

$factory->define(App\Entities\DetailingflowType::class, function (Faker\Generator $facker) {
    return [
        'name' => $facker->name
    ];
});

$factory->define(App\Entities\CostType::class, function (Faker\Generator $facker) {
    return [
        'name' => $facker->name
    ];
});

$factory->define(App\Entities\Unit::class, function (Faker\Generator $facker) {
    return [
        'name' => $facker->name
    ];
});
