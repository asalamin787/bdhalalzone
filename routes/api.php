<?php

use App\Models\Prodcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories/filter', function (Request $request) {
    $request->validate([
        'categories' => 'required'
    ]);
    $categories = Prodcat::whereIn('id', explode(',', $request->categories))->with('filters')->get();
    $filters = collect([]);
    foreach ($categories as $category) {
        $filters = $filters->merge($category->filters);
    }
    
    $filters = $filters->unique('id');
    return response()->json($filters);
})->name('api.filters');
