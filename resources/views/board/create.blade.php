@extends('layouts.app')

@section('content')
	<div class="d-flex align-items-center">
		<h1>掲示板作成</h1>
		<div class="ml-auto boards__linkBox">
			<a class="btn btn-outline-dark" href="{{route('boards.index')}}">掲示板一覧</a>
		</div>
	</div>
	
	@if(!empty($errors))
		<div>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="author">名前</label>
			<input class="form-control" type="text" id="author" name="author" value="{{ old('author') }}" />
		</div>
		<div class="form-group">
			<label for="title">タイトル</label>
			<input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" />
		</div>
		<div class="form-group">
			<label for="body">本文</label>
			<textarea class="form-control" type="text" id="body" name="body" rows="10" value="{{ old('body') }}"></textarea>
		</div>
		{{--			<div class="form-group">--}}
		{{--				<span>タグ</span>--}}
		{{--				<%= f.collection_check_boxes(:tag_ids, Tag.all, :id, :name) do |tag| %>--}}
		{{--				<div class="form-check">--}}
		{{--					<%= tag.label class: 'form-check-label' do %>--}}
		{{--					<%= tag.check_box class: 'form-check-input' %>--}}
		{{--					<%= tag.text %>--}}
		{{--					<% end %>--}}
		{{--				</div>--}}
		{{--				<% end %>--}}
		{{--			</div>--}}
		<input class="btn btn-primary" type="submit" value="保存">
	</form>
@endsection