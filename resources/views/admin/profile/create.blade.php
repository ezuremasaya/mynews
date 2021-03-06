@extends('layouts.admin')
@section('title', 'プロフィールの新規作成')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>Myプロフィール作成</h2>
            <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <!-- 氏名 -->
                    <label class="col-md-2" for="name">氏名</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <!-- 性別 -->
                <div class="form-group row">
                    <label class="col-md-2" for="gender">性別</label>
                    <div class="col-md-10">
                        <input type="radio" name="gender" value="男性" @if(old('gender') === '男性') checked="chaecked" @endif class="mb-3">男性<br>
                        <input type="radio" name="gender" value="女性" @if(old('gender') === '女性') checked="chaecked" @endif>女性
                    </div>
                </div>
                <!-- 趣味 -->
                <div class="form-group row">
                    <label class="col-md-2" for="hobby">趣味</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="hobby" rows="10">{{ old('hobby') }}</textarea>
                    </div>
                </div>
                <!-- 自己紹介欄 -->
                <div class="form-group row">
                    <label class="col-md-2" for="introduction">自己紹介欄</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                    </div>
                </div>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
            </form>
        </div>
    </div>
</div>
@endsection