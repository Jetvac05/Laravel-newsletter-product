<?php

namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    public static function find($slug)
    {
        // base_path();
        // app_path();
        // resource_path();
        $path = resource_path("posts/{$slug}.html");

        if (! file_exists($path)) {
            throw new ModelNotFoundException();
            //ddd('file does not exist');
            // return redirect('/');
            abort(404);
        }
    
        return cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));
    }
}