@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center">
        <h1>掲示板一覧</h1>

        <!-- 検索セレクトボックス -->
        {{--        <div class="ml-auto boards__linkBox">--}}
        {{--            <%= form_with url: boards_path, method: :get, class: 'boards__searchForm' do %>--}}
        {{--            <!-- [MEMO] select_tagヘルパでセレクトボックスが作成できる -->--}}
        {{--            <!-- 第一引数：セレクトボックスのname属性 -->--}}
        {{--            <%= select_tag :tag_id,--}}
        {{--            # [MEMO] options_from_collection_for_selectヘルパでoptionが複数作成できる--}}
        {{--            # 第一引数：optionの元になるデータ--}}
        {{--            # 第二引数：optionのvalueに設定される値--}}
        {{--            # 第三引数：optionの表示名--}}
        {{--            # 第四引数：選択状態の初期値。前回の検索時の情報を引き継ぐ場合に指定--}}
        {{--            options_from_collection_for_select(Tag.all, :id, :name, params[:tag_id]),--}}
        {{--            {--}}
        {{--            # セレクトボックスで何も選択されていない場合の表示--}}
        {{--            prompt: 'タグで絞り込み',--}}
        {{--            class: 'form-control boards__select',--}}
        {{--            # onchange時に実行するjavascriptコード--}}
        {{--            onchange: 'submit(this.form);'--}}
        {{--            }--}}
        {{--            %>--}}
        {{--            <% end %>--}}
        {{--        </div>--}}

        <div class="ml-auto boards__linkBox">
            <a class="btn btn-outline-dark" href="{{route('boards.create')}}">新規作成</a>
        </div>
    </div>

    @if (session('flash_message'))
        <div class="alert alert-success">
            {{session('flash_message')}}
        </div>
    @endif

    <table class="table table-hover boards__table">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>タイトル</th>
            <th>作成者</th>
            <th>作成日時</th>
            <th>更新日時</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($boards as $board)
            <tr>
                <th>{{$board->id}}</th>
                <td>{{$board->title}}</td>
                <td>{{$board->name}}</td>
                <td>{{$board->created_at}}</td>
                <td>{{$board->updated_at}}</td>
                <td><a class="btn btn-outline-dark" href="{{route('boards.show', ['id' => $board->id])}}">詳細</a></td>
                <td>
                    <form action="{{ action('BoardController@destroy', $board->id) }}" method="post"
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-outline-dark" value="削除"/>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $boards->render() }}
    </div>
@endsection
