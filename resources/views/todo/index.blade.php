@extends('layouts.app')

@section('title', 'Todoリスト')

@section('content')
	{{--{{ Breadcrumbs::render('todo') }}--}}
	<main class="content">
		<div class="container">
			<div class="todo-add__btn">
				<a href="{{ route('add') }}" class="btn-floating waves-effect waves-light todo-add__link">
					<i class="material-icons">add</i>
				</a>
			</div>
			<div class="todo-list">
				@foreach($todos as $todo)
					<div class="row todo">
						<div class="col s11 todo-content">
							<div class="todo-content__title">
								<div class="todo-content__icon">
									<i class="midium material-icons">title</i>
								</div>
								<div class="todo-content__text">
									{{ $todo->title }}
								</div>
							</div>
							<div class="todo-content__body">
								<div class="todo-content__icon">
									<i class="midium material-icons">short_text</i>
								</div>
								<div class="todo-content__text">
									{{ $todo->body }}
								</div>
							</div>
							<div class="todo-content__limit">
								<div class="todo-content__icon">
									<i class="midium material-icons">timer</i>
								</div>
								<div class="todo-content__text">
									{{ $todo->limit }}
								</div>
							</div>
						</div>
						<div class="col s1 todo-btns">
							<div class="todo-edit__link">
								<a href="{{ route('edit', ['id' => $todo['id']]) }}" class="btn-floating btn-medium waves-effect waves-light green"><i class="material-icons">edit</i></a>
							</div>
							<div class="todo-delete__link">
								<a href="{{ route('delete', ['id' => $todo['id']]) }}" class="btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">delete</i></a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			{{ $todos->links('vendor.pagination.default') }}
		</div>
	</main>
@endsection