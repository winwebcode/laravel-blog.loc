<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'title' => 'required'
        ]);
        Category::create($request->all()); // создаёт категорию, на основе post запроса из поля title в модели прописано fillable = [' title'] для ловли title. Метод create от laravel
        return redirect()->route('categories.index'); //
    }

    public function edit($id)
    {
        $category = Category::find($id);
       /*$categoryName2 = DB::table('categories')
            ->where('title', '=', $id)
            ->get();
        foreach ($categoryName2 as $category) {}*/

       return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
       // dd($request->all(), $id);
        $category = Category::find($id);
       // $category = DB::table('categories')->where('title', '=', $title)->first();

        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index');
    }
}
