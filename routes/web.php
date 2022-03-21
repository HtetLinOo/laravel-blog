<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('blogs');
});
Route::get('/blogs/{blogitem}',function($slug){
    $path = __DIR__."/../resources/blogs/$slug.html";
    if(!file_exists($path)){
        return redirect('/');
    }
        $blog = cache()->remember("posts.$slug",now()->addMinutes(2),function () use ($path){
            var_dump("file get contents");
       return file_get_contents($path);
    });
    return view('blog',[
        'blog'=>$blog
    ]);
})->where('blogitem','[A-z\d\-_]+');