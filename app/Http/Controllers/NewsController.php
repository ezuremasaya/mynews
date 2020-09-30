<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if($cond_title != '') {
            $posts = News::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
        } else {
            // News::all()：全てのnewsテーブルを取得するメソッド
            // sortBy/sortByDesc：ソート（並び替え）をするメソッド
            // sortBy：昇順、sortByDesc：降順
            // つまり、下記のコードは投稿日時を新しい順で並べている
            $posts = News::all()->sortByDesc('updated_at');
        }

        if(count($posts) > 0) {
            // shift()：配列の最初のデータを削除し、削除した値を返すメソッド
            // 下記のコードは、最新記事を「$headline」に代入し、最新記事以外のものは「$post」に格納している
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

           // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、 cond_title という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }
}
