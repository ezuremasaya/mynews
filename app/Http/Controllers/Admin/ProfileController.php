<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Profile Modelの使用を宣言
use App\Profile;

class ProfileController extends Controller
{
    //以下の内容を追加
    public function add()
    {
        // view('admin.profile.create')：admin/profile ディレクトリ直下の create.blade.php のファイルを呼び出す
        // つまり、resources/views/admin/profile ディレクトリ配下に「create.blade.php」ファイルを作成する必要がある
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        // バリデーションを実行
        $this->validate($request, Profile::$rules);

        $profile = new Profile;
        $form = $request->all();

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $profile->fill($form);
        $profile->save();

        return redirect('admin/profile/create');
    }

    public function edit()
    {
        // view('admin.edit.create')：admin/profile ディレクトリ配下にある「edit.blade.php」のファイルを呼び出す
        // つまり、resources/views/admin/profile ディレクトリ配下に「edit.blade.php」ファイルを作成する必要がある
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
}