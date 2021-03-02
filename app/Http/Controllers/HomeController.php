<?php

namespace App\Http\Controllers;

use App\Advertisment;
use App\Category;
use App\Post;
use App\Settings;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    public function index()
    {
        //seo tags for homepage
        $seoMeta = [
            'title' => 'CMS on Laravel 2021',
            'description' => 'CMS on Laravel 2021',
            'keywords' => 'CMS on Laravel 2021'
        ];
        $posts = Post::where('status', '=', Post::IS_PUBLIC)->paginate(2);

        return view('pages.index', compact(
            'posts',
            'seoMeta'
        ));
    }

    public function show($slug)
    {
        //Advertisement
        $adAfterTitle = Advertisment::where('name', '=','afterTitle')->first();
        $adEndOfPost = Advertisment::where('name', '=','endOfPost')->first();

        $post = Cache::remember($slug, 86400, function () use ($slug)  {
            return Post::where('slug', $slug)->firstOrFail();
        });

        $commentsStatus = Cache::remember('_allComments', 1, function () {
            return Settings::all();
        });

        return view('pages.show', compact('post',
            'commentsStatus',
        'adEndOfPost',
        'adAfterTitle'
        ));
    }

    public function tag($slug)
    {
        $tag = Cache::remember($slug, 86400, function () use ($slug)  {
            return Tag::where('slug', $slug)->firstOrFail();
        });
        $posts = $tag->posts()->paginate(2); // здесь не поле таблицы Tag с названием posts, а связь через метод

        return view('pages.list', compact('posts'));
    }

    public function category($slug)
    {
        $category = Cache::remember($slug, 86400, function () use ($slug)  {
            return Category::where('slug', $slug)->firstOrFail();
        });
        $posts = $category->posts()->paginate(2);

        return view('pages.list', compact('posts'));
    }
}
