<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
      return view('folders/create');
    }



     // 引数にインポートしたRequestクラスを受け入れる
     public function create(CreateFolder $request)
    {
      // フォルダモデルのインスタンスを作成する
      $folder = new Folder();
      // タイトルに入力値を代入する
      $folder->title = $request->title;
      Auth::user()->folders()->save($folder);
      // インスタンスの状態をデータベースに書き込む、これだけか
      $folder->save();

      return redirect()->route('tasks.index', [
        'id' => $folder->id,
      ]);
    }
}
