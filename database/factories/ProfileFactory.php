<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'dob'=>now(),
        'gender'=>'other',
        'description'=>'I am an interessting person',
        'city'=>'Bremen',
        'relationshipstatus'=>'Fuck bodies',
        'work'=>'Escort service',
        'education'=>'Fourth grade on Boston elementary'
    ];
});
