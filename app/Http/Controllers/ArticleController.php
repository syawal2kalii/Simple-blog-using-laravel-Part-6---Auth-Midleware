<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles=Article::all();
//        foreach ($article as $artic => $data)
//        dd($data->title);
        return view("articles",compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function form(){
        return view("addArticle");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title'=> 'required',
            'category'=> 'required',
            'contentt'=> 'required',
            'imgurl' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);

        Article::create([
            'title'=>$request->title,
            'category'=> $request->category,
            'content'=> $request->contentt,
            'imgurl'=> Storage::putFile('public/photos',$request->file("imgurl")),
            'slug' => \Str::slug($request->title).'-'.\Str::random(10),
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->route("article.form");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $cat=['politik','hiburan','education'];//pengganti database
        return view('edit',compact('article','cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        // validate form
        $data = request()->validate([
            'title'=> 'required|max:255',
            'category'=> 'required',
            'content'=> 'required',
            'imgurl' => 'mimes:jpeg,bmp,png,jpg',
        ]);
        $data['imgurl'] = Storage::putFile('public/photos',$request->file('imgurl'));
        $data['slug'] =Str::slug(request('title').'-'.Str::random(10));

        if(!empty(request('imgurl'))){
            Storage::delete($article->imgurl);
        }
        $article->update($data);
        return redirect()->route('article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article::whereSlug($article->slug)->delete();
        Storage::delete($article->imgurl);
        return redirect(route("article"));
    }

    public function detail(Article $article){
        return view("detail",compact("article"));
    }

}
