@extends('layouts.app')

@section('title', 'Todoリスト|削除')

@section('content')
	<main class="content">
		<div class="container">
			<div class="breadcrumbs">
				<a href="{{ route('top') }}" class="breadcrumbs__item">Todoリスト</a>
				<span class="breadcrumbs__item">削除</span>
			</div>
			@if(count($errors) > 0)
				<p>入力に問題があります。再入力してください。</p>
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form class="todo-delete" method="post">
				{{ csrf_field() }}
				<div class="row">
					<div class="col s12 todo-delete__title">
						<i class="midium material-icons prefix todo-delete__icon">title</i>
						<span class="todo-delete__text">{{ $todo->title }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col s12 todo-delete__body">
						<i class="midium material-icons prefix todo-delete__icon">short_text</i>
						<span class="todo-delete__text">{{ $todo->body }}</span>
					</div>
				</div>
				<div class="row">
					<div class="col s12 todo-delete__limit">
						<i class="midium material-icons prefix todo-delete__icon">timer</i>
						<span class="todo-delete__text">{{ $todo->limit }}</span>
					</div>
				</div>
				<div class="todo-delete__btns">
					<button type="submit" class="btn-floating waves-effect waves-light todo-add__execute-btn">
						<i class="material-icons">delete</i>
					</button>
					<a href="{{ route('top') }}" class="btn-floating waves-effect waves-light todo-add__back-btn">
						<i class="material-icons">cancel</i>
					</a>
				</div>
			</form>
		</div>
	</main>
@endsection