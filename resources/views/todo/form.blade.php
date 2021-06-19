<form
  action="{{Route::currentRouteName() === 'todos.create' ? action('TodoController@store') : action('TodoController@update', ['todo' => $todo->id]) }}"
  method="POST">
  @csrf
  @if (Route::currentRouteName() === 'todos.edit')
    @method('PUT')
  @endif
  <div class="form-group">
    <label for="title">タイトル</label>
    <input class="form-control" type="text" id="title" name="title"
           value="{{ old('title') ?? $todo->title ?? ''}}"/>
  </div>
  <div class="form-group">
    <label for="body">詳細</label>
    <textarea class="form-control" type="text" id="body" name="body"
              rows="10">{{ old('body') ?? $todo->body ?? ''}}</textarea>
  </div>
  <div class="form-group">
    <span>期限</span>
    <input class="form-control" type="text" id="limit" name="limit"
           value="{{ old('limit') ?? isset($todo->limit) ? date('Y/m/d', strtotime($todo->limit)) : ''}}"/>
  </div>
  <div class="form-group text-center">
    <input class="btn btn-secondary" type="submit" value="保存">
  </div>
</form>
