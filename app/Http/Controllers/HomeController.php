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
        $seoMeta = Settings::setMetaTagsForIndex("CMS on Laravel 2021", "CMS on Laravel 2021", "CMS on Laravel 2021");
        // кэш 4 часа
        $posts = Cache::remember('allPosts', 14400, function () {
            return Post::where('status', '=', Post::IS_PUBLIC)->paginate(2);
        });

        return view('pages.index', compact(
            'posts',
            'seoMeta'
        ));
    }

    public function show($slug)
    {
        $seo = Post::where('slug', $slug)->firstOrFail();
        $seoMeta = Settings::setMetaTagsForIndex("$seo->title", "$seo->description", "$seo->keywords");

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
            'seoMeta',
        'adEndOfPost',
        'adAfterTitle'
        ));
    }

    public function tag($slug)
    {
        $seoMeta = Settings::setMetaTagsForIndex("$slug" );
        $tag = Cache::remember($slug, 86400, function () use ($slug)  {
            return Tag::where('slug', $slug)->firstOrFail();
        });

        $posts = $tag->posts()->paginate(2); // здесь не поле таблицы Tag с названием posts, а связь через метод

        return view('pages.list', compact('posts',
            'seoMeta'));
    }

    public function category($slug)
    {
        $seoMeta = Settings::setMetaTagsForIndex("$slug");

        $category = Cache::remember($slug, 86400, function () use ($slug)  {
            return Category::where('slug', $slug)->firstOrFail();
        });

        $posts = $category->posts()->paginate(2);
        return view('pages.list', compact('posts',
        'seoMeta'));
    }
}
