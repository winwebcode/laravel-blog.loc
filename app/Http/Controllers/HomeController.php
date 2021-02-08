<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', '=', Post::IS_PUBLIC)->paginate(2);

        return view('pages.index', compact(
            'posts'
        ));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('pages.show', compact('post'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(2); // здесь не поле таблицы Tag с названием posts, а связь через метод

        return view('pages.list', compact('posts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(2);
        return view('pages.list', compact('posts'));
    }

   protected function setMetaTags($slug)
    {//SEO
        $metaTags = Post::where('slug', $slug)->firstOrFail();
        return view('layout', compact('metaTags'));
    }
}
