<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //全ての記事を閲覧できる
    public function index()
    {
        $topics = Topic::latest()->get();
        return view('category.index', compact('topics'));
    }

    // 犬のカテゴリーに属する記事を閲覧できる
    public function dog()
    {
        $topics = Topic::where('category_id', 1)->latest()->get();
        return view('category.dog', compact('topics'));
    }

    // 猫のカテゴリーに属する記事を閲覧できる
    public function cat()
    {
        $topics = Topic::where('category_id', 2)->latest()->get();
        return view('category.cat', compact('topics'));
    }

    // 鳥のカテゴリーに属する記事を閲覧できる
    public function bird()
    {
        $topics = Topic::where('category_id', 3)->latest()->get();
        return view('category.bird', compact('topics'));
    }
}

