@extends('layouts.app')

@section('content')
	<div class="d-flex align-items-center">
		<h1>掲示板作成</h1>
		<div class="ml-auto boards__linkBox">
			<a class="btn btn-outline-dark" href="{{route('boards.index')}}">掲示板一覧</a>
		</div>
	</div>
	
	@include('common.error_message')
	@include('board.form')
@endsection