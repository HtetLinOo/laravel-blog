<?php
namespace App\Models;


class Blog{
    public static function find($slug){
        //  $path = __DIR__."/../resources/blogs/$slug.html";
         $path =resource_path("blogs/$slug.html");
        if(!file_exists($path)){
            return redirect('/');
        }
        return cache()->remember("posts.$slug",now()->addMinutes(2),function () use ($path){
           return file_get_contents($path);
        });
    }

}