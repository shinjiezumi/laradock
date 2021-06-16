<form
  action="{{Route::currentRouteName() === 'boards.create' ? action('BoardController@store') : action('BoardController@update', ['board' => $board->id]) }}"
  method="POST">
  @csrf
  @if (Route::currentRouteName() === 'boards.edit')
    @method('PUT')
  @endif
  <div class="form-group">
    <label for="name">名前</label>
    <input class="form-control" type="text" id="name" name="name"
           value="{{ old('name') ?? $board->name ?? ''}}"/>
  </div>
  <div class="form-group">
    <label for="title">タイトル</label>
    <input class="form-control" type="text" id="title" name="title"
           value="{{ old('title') ?? $board->title ?? ''}}"/>
  </div>
  <div class="form-group">
    <label for="body">本文</label>
    <textarea class="form-control" type="text" id="body" name="body"
              rows="10">{{ old('body') ?? $board->body ?? ''}}</textarea>
  </div>
  <div class="form-group">
    <span>タグ</span>
    @foreach($tags as $tag)
      <div class="form-check">
        <label class="form-check-label"></label>
        <input class="form-check-input" type="checkbox"
               name="tags[]"
               value="{{$tag->id}}" {{ in_array($tag->id, (old('tags') ?? $currentTags ?? [])) ? 'checked' : ''}}/>
        {{$tag->name}}
      </div>
    @endforeach
  </div>
  <div class="form-group text-center">
    <input class="btn btn-secondary" type="submit" value="保存">
  </div>
</form>
