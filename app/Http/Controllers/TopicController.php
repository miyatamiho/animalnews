<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\Category;

use App\Models\Topic;

class TopicController extends Controller
{
    public function add()
    {
        $categories = Category::all();
        return view('topic.create')->with('categories', $categories);
    }
    
    //記事投稿をする
    public function create(Request $request)
    {
        $this->validate($request, Topic::$rules);

        $topic = new Topic;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $topic->image_path = basename($path);
        } else {
            $topic->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $topic->fill($form);
        $topic->user_id = Auth::id();
        $topic->save();
        
        return redirect('topic/create');
    }
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Topic::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Topic::all();
        }
        return view('topic.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
    {
        $topic = Topic::find($request->id);
        if (empty($topic)) {
            abort(404);
        }    
        return view('topic.edit', ['news_form' => $topic]);
    }
    public function update(Request $request)
    {
        $this->validate($request, Topic::$rules);
        // News Modelからデータを取得する
        $topic = Topic::find($request->id);
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
        $topic->fill($news_form)->save();
        
        $record = new Record();
        $record->animalnews_id = $topic->id;
        $record->edited_at = Carbon::now();
        $record->save();
        
        return redirect('topic');
    }
    public function search(Request $request)
    {
    $keyword = $request->input('keyword');
    $topics = Topic::where('title', 'LIKE', "%{$keyword}%")
                  ->orWhere('body', 'LIKE', "%{$keyword}%")
                  ->get();
    return view('topic.index', compact('topics'));
    }
}
