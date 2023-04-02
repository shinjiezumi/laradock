@include('common.error_message')
<div class="p-comment__formBox">
  <p class="p-comment__formTitle">コメント記入</p>
  <form action="{{route('comments.store', ['id' => $board->id])}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">名前</label>
      <input type="text" name="name" class="form-control"/>
    </div>
    <div class="form-group">
      <label for="comment">コメント</label>
      <textarea name="comment" class="form-control" rows="4"></textarea>
    </div>
    <input type="submit" class="btn btn-secondary">
  </form>
</div>
