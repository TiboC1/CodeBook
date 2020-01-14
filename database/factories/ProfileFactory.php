<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'nickname'=>'name',
        'dob'=>now(),
        'gender'=>'other',
        'description'=>'I am an interessting person',
        'city'=>'Bremen',
        'relationshipstatus'=>'Fuck bodies',
        'work'=>'Escort service',
        'education'=>'Fourth grade on Boston elementary'
    ];
});
