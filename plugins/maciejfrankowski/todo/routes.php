<?php

use Maciejfrankowski\Todo\Models\Todo;
//use Symfony\Component\HttpFoundation\Response;

Route::get('api/populate', function() {
    $faker = Faker\Factory::create();

    for($i=0; $i< 20; $i++) {
        Todo::create([
            'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'description' => $faker->text($maxNbCahrs = 200),
            'status' => $faker->boolean($chanceOfGettingTrue = 50),
            'created_at' => $faker->date($format = 'Y-m-d H:i:s', $Max = 'now')
        ]);
    }

    return "Todos created";
});


Route::get('api/todos', function() {
    $todos = Todo::all();
    //return $todos;
    return response($todos)->header('Access-Control-Allow-Origin', '*');
});