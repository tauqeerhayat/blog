<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(){

        $value = config('app.timezone');
        return view('posts.index', [
            'posts' => Post::latest()->filter(\request(['search', 'category', 'author']))->paginate()->withQueryString
            (),
        ]);
    }

    public function show(Post $post){

        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();

        Post::create($attributes);

        return redirect('/');
    }

}
