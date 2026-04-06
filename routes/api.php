<?php

use App\Http\Controllers\api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/testApi', function () {
    return response()->json(['message' => 'API is working']);
});




?>