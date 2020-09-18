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

    // データの編集
    public function edit(Request $request)
    {
        // Profile Modelからデータを取得
        $profile = Profile::find($request->id);
        // 中身が空であれば、エラーレスポンスを返す
        if (empty($profile)) {
            abort(404);
        }

        // view('admin.edit.create')：admin/profile ディレクトリ配下にある「edit.blade.php」のファイルを呼び出す
        // Profileインスタンスが、edit.blade.phpのフォームのvalueに表示される
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    // データの更新
    public function update(Request $request)
    {
        // バリデーションをかける
        $this->validate($request, Profile::$rules);

        // Profile Modelからデータを取得
        $profile = Profile::find($request->id);
        // フォームデータを格納
        $profile_form = $request->all();
        unset($profile_form['_token']);

        // 該当データを上書き保存
        $profile->fill($profile_form)->save();

        return redirect('admin/profile');
    }

    public function index(Request $request)
    {
        // $cond_nameに$requestの中にあるcond_nameの値を代入
        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('name', $cond_name)->get();
        } else {
            // それ以外はすべての自己紹介を取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }

    // データの削除
    public function delete(Request $request) {
        // Profile Modelを取得
        $profile = Profile::find($request->id);
        // 削除する
        $profile->delete();
        return redirect('admin/profile');
    }
}
