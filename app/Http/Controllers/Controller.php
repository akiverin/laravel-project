<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Article;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $sliderArticles = Article::where('slider', true)->get();
        // $articles = json_decode(file_get_contents(public_path().'/articles.json'), true);
       return view('main.main', ['sliderArticles' => $sliderArticles]);
    }
}
