<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //
    public function add()
    {
        // 「return」で戻り値を指定
        // 戻り値で返される値が、そのアドレスにアクセスした時に表示
        return view('admin.news.create');

        // view('admin.news.create')：admin/news ディレクトリ直下の create.blade.php のファイルを呼び出すという意味
        // つまり、resources/views/admin/news ディレクトリ配下に「create.blade.php」ファイルを作成しなければならない
    }
}
