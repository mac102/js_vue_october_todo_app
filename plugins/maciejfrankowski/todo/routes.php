<?php

use Maciejfrankowski\Todo\Models\Todo;
use Illuminate\Http\Request;

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

/**
 * Create array from request string
 * 
 * There is'a problem with (probably related with CORS) POST and application/json content type from axios library.
 * Only application/x-www-form-urlencoded is passing.
 *
 * TODO: fix this..
 *
 * @param Request $req
 * @return array
 */
function getDataFromReq(Request $req): array {
    return json_decode(
        $req->getContent(),
        true
    );
}