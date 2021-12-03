<?php


use \Illuminate\Support\Facades\Route;

//
//Route::get('posts', [\App\Http\Controllers\PostController::class ,'index' ]);
//Route::post('posts', [\App\Http\Controllers\PostController::class ,'store' ]);
//Route::get('posts/{id}', [\App\Http\Controllers\PostController::class ,'show' ]);
//Route::put('posts/{id}', [\App\Http\Controllers\PostController::class ,'update' ]);
//Route::delete('posts/{id}', [\App\Http\Controllers\PostController::class ,'destroy' ]);



Route::group(['middleware' => 'auth:sanctum'],function (){

    Route::get('me',function (\Illuminate\Http\Request $request){
        return response()->json(['user'=>$request->user()]);
    });

    Route::apiResource('posts', \App\Http\Controllers\PostController::class);
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
    Route::apiResource('tags', \App\Http\Controllers\TagController::class);
    Route::apiResource('cate', \App\Http\Controllers\CategoryController::class);
});

Route::get('auth/login',function (){
    $user=\App\Models\User::find(1);
    $token=$user->createToken('token_name');
    return['token'=>$token->plainTextToken];
});
