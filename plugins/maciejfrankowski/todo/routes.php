<?php

use Maciejfrankowski\Todo\Models\Todo;
use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Request;

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
    //return response($todos)->header('Access-Control-Allow-Origin', '*');
    return $todos;
});

Route::post('api/add-todo', function(Request $req){
    $data = getDataFromReq($req);
    Todo::create($data);
});

Route::post('api/delete-todo', function(Request $req){
    $data = getDataFromReq($req);
    Todo::destroy($data['id']);
});

Route::post('api/toggle-todo', function(Request $req){
    $data = getDataFromReq($req);
    Todo::where('id', $data['id'])->update(['status' => $data['status']]);
});

Route::post('api/update-todo', function(Request $req){
    $data = getDataFromReq($req);
    Todo::where('id', $data['id'])
        ->update(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status']
            ]
        );
});

function getDataFromReq(Request $req): array {
    return json_decode(
        $req->getContent(),
        true
    );
}