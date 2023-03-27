<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function add()
    {
        return view('animalnews.create');
    }
    
    //記事投稿をする
    public function create(Request $request)
    {
        $this->validate($request, Animal::$rules);

        $animal = new Animal;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $animal->image_path = basename($path);
        } else {
            $animal->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $animal->fill($form);
        $animal->save();
        
        return redirect('animalnews/create');
    }
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Animal::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Animal::all();
        }
        return view('admin.animalnews.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
    {
        $animal = Animal::find($request->id);
        if (empty($animal)) {
            abort(404);
        }    
        return view('animalnews.edit', ['news_form' => $animal]);
    }
    public function update(Request $request)
    {
        $this->validate($request, Animal::$rules);
        // News Modelからデータを取得する
        $animal = Animal::find($request->id);
        // 送信されてきたフォームデータを格納する
        $news_form = $request->all();
        
        if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
        } else {
            $news_form['image_path'] = $animal->image_path;
        }

        unset($news_form['image']);
        unset($news_form['remove']);
        unset($news_form['_token']);
        
        // 該当するデータを上書きして保存する
        $animal->fill($news_form)->save();
        
        $record = new Record();
        $record->animal_id = $animal->id;
        $record->edited_at = Carbon::now();
        $record->save();
        
        return redirect('animalnews');
    }
    public function search(Request $request)
    {
    $keyword = $request->input('keyword');
    $topics = Topic::where('title', 'LIKE', "%{$keyword}%")
                  ->orWhere('body', 'LIKE', "%{$keyword}%")
                  ->get();
    return view('animalnews.index', compact('topics'));
    }
}
