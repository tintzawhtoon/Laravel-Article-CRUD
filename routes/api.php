<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('/categories', CategoryApiController::class)->middleware('auth:sanctum');

Route::post('/login', function () {
    $email = request()->email;
    $password = request()->password;

    $user = User::where("email", $email)->first();

    if($user) {
        if(password_verify($password, $user->password)) {
            return $user->createToken('device')->plainTextToken;
        }
    }

    return response(["msg" => "Incorrect email or password."], 401);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
