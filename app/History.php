<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = array('id');

    public $rules = array(
        // 外部キー：関連するもう１つのテーブルのレコードIDを保管しておくフィールド
        // 今回は「news_id」が該当
        'news_id' => 'required',
        'edited_at' => 'required',
    );
}
