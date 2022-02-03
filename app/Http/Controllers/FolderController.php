<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolder;
use App\Models\Folder;
use Illuminate\Http\Request;

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

        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        return redirect()->route('tasks.index', ['id' => $folder->id,]);
    }
}
