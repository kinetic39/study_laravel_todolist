<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolder;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    //
    public function showCreateForm()
    {
        # code...
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        # code...

        // フォルダモデルのインスタンスを作成する。
        $folder = new Folder();

        // タイトルに入力値を代入する。
        $folder->title = $request->title;


        // ユーザに紐づけて保存する
        Auth::user()->folders()->save($folder);

        // インスタンスの状態をデータベースに書き込む
        //$folder->save();

        return redirect()->route('tasks.index', ['folder' => $folder->id,]);
    }
}
