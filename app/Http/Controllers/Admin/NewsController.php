<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでNews Modelが扱えるようになる
use App\News;

class NewsController extends Controller
{
    public function add()
    {
        return view('admin.news.create');
    }

    public function create(Request $request)
    {

        // Varidationを行う
        $this->validate($request, News::$rules);

        $news = new News;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $news->fill($form);
        $news->save();

        return redirect('admin/news/create');
    }

    public function index(Request $request)
    {
        // $cond_titleに$requestの中にあるcond_titleの値を代入
        // もし$requestにcond_titleがなければ、nullを返す
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = News::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = News::all();
        }
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    // 以下を追記（データの編集）
    public function edit(Request $request)
    {
        // News Modelから（idパラメータの値の）データを取得する
        $news = News::find($request->id);
        if (empty($news)) {
            // abort関数：エラー系のレスポンスを返す
            // 引数のレスポンスコードで、対応するエラーページに移動
            abort(404);
        }
        return view('admin.news.edit', ['news_form' => $news]);
    }

    // データの更新
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, News::$rules);

        // News Modelからデータを取得する
        $news = News::find($request->id);

        // 送信されてきたフォームデータを格納する
        $news_form = $request->all();

        // 画像が送信されてきたら、$news->image_path に画像のパスを保存する
        if (isset($news_form['image'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
            // フォームから送信されたimageを削除
            unset($news_form['image']);

            // 画像削除時、チェックボックスにチェックがついていれば処理される
        } elseif (0 == strcmp($request->remove, 'true')) {
            $news->image_path = null;
        }

        // フォームから送信された'_token'を削除
        unset($news_form['_token']);
        // フォームから送信された'remove'を削除
        unset($news_form['remove']);

        // 該当するデータを上書きして保存する
        // 以下の短縮形である
        // $news->fill($news_form);
        // $news->save();
        $news->fill($news_form)->save();

        return redirect('admin/news');
    }

    // 以下を追記（データの削除）
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $news = News::find($request->id);
        // 削除する
        // deleteメソッドでデータの削除を行う
        $news->delete();
        return redirect('admin/news/');
    }
}
