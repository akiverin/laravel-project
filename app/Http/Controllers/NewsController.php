<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;


class NewsController extends Controller
{
    public function index(){
        // $articles = Article::paginate(5);
        $articles = Article::latest()->paginate(10);
        // $articles = json_decode(file_get_contents(public_path().'/articles.json'), true);
       return view('news.index', ['articles' => $articles]);
    }

    public function show($id){
        $article = Article::FindOrFail($id);
        $comments=Comment::where('article_id', $id)->latest()->paginate(2);
        $article->views = $article->views + 1;
        $article->save();
        return view('news.article', ['article' => $article, 'comments'=>$comments]);
    }

    public function image($full){
        return view('main.gallery', ['full' => $full]);
    }

    public function create() {
        $this->authorize('create', [self::class]);
        return view('news.create');
    }

    public function store(Request $request) {
        $this->authorize('create', [self::class]);
        $request->validate([
            'date' => 'required',
            'name' => 'required',
            'desc' => 'required',
        ]);
        $article = new Article();
        $article->name = request('name');
        $article->slider = request('slider');

        $article->shortDesc = request('shortDesc');
        $article->desc = request('desc');
        $article->date = request('date');
        $article->save();
        return redirect('/');
    }

    public function edit($id){
        $article = Article::FindOrFail($id);
        $this->authorize('update', [self::class, $article]);
        return view('news.edit', ['article' => $article]);;
    }

    public function update(Request $request, $id){
        $request->validate([
            'date' => 'required',
            'name' => 'required',
            'desc' => 'required',
        ]);
        $article = Article::FindOrFail($id);
        $this->authorize('update', [self::class, $article]);
        $article->date = request('date');
        $article->name = request('name');
        $article->shortDesc = request('shortDesc');
        $article->desc = request('desc');
        $article->save();
        // return redirect()->route('show',['id'=>$article->id]);
        return redirect('/');
        
    }

    public function delete($id)
    {
        $article = Article::FindOrFail($id);
        $this->authorize('delete', [self::class, $article]);
        Comment::where('article_id', $article->id)->delete();
        $article->delete();
        return redirect('/');
    }
}