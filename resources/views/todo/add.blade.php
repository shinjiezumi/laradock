@extends('layouts.app')

@section('title', 'Todoリスト|追加')

@section('content')
	<main class="content">
		<div class="container">
			<div class="breadcrumbs">
				<a href="{{ route('top') }}" class="breadcrumbs__item">Todoリスト</a>
				<span class="breadcrumbs__item">追加</span>
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
			<form method="post">
				{{ csrf_field() }}
				<div class="row">
					<div class="col s12	input-field">
						<i class="midium material-icons prefix">title</i>
						<input name="title" id="title" type="text" class="validate" value="{{ old('title') }}">
						<label for="title">title</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12 input-field">
						<i class="midium material-icons prefix">short_text</i>
						<textarea name="body" id="body" cols="30" rows="10" class="materialize-textarea">{{ old('body') }}</textarea>
						<label for="body">body</label>
					</div>
				</div>
				<div class="row">
					<div class="col s6 input-field">
						<i class="midium material-icons prefix">timer</i>
						<input name="limit-date" id="limit-date" type="text" class="datepicker validate" value="{{ old('limit-date') }}">
						<label for="limit-date">date</label>
					</div>
					<div class="col s6 input-field">
						<input name="limit-time" id="limit-time" type="text" class="timepicker validate" value="{{ old('limit-time') }}">
						<label for="limit-time">time</label>
					</div>
				</div>
				<div class="center todo-add__btns">
					<button type="submit" class="btn-floating waves-effect waves-light todo-delete__execute-btn">
						<i class="material-icons">add</i>
					</button>
					<a href="{{ route('top') }}" class="btn-floating waves-effect waves-light todo-delete__back-btn">
						<i class="material-icons">cancel</i>
					</a>
				</div>
			</form>
		</div>
	</main>
@endsection
