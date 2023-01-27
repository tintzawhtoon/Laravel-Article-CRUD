<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;
class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::latest()->paginate();
        return view('articles.index', [
            "articles" => $article
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);
        return view("articles.detail", [
            'article' => $article
        ]);
    }

    public function add()
    {
        $categories = Category::all();
        return view("articles.add",[
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        return view("articles.edit",[
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = Article::find($id) ;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article)) {
            $article->delete();
            return redirect('/articles')->with("info", "An article was deleted successfully.");
        }
        return back()->with("info", "Unauthorize to delete this article.");
    }
}
