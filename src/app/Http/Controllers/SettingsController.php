<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
//        request()->session()->flash('mysites_message', 'マイコレがありません。登録ボタンから登録してください');
        return view('mycolle.settings');
    }


}
