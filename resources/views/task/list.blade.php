@extends('layouts.app')

@section('content')
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="/task">Task App</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row my-4">
                        <div class="col-md-6 mx-auto">
                            <form action="{{ route('task.create') }}" method="POST">
                                @csrf
                                <div class="input-group gap-3">
                                    <input class="form-control form-control-sm border-0 border-bottom" type="text" name="title" placeholder="Title" required>
                                    <input class="form-control form-control-sm border-0 border-bottom" type="text" name="description" placeholder="Description" required>
                                    <button type="submit" class="btn btn-sm btn-primary rounded">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>

					@if(\Session::has('message'))
					<div class="row my-2">
						<div class="col-12">
							<span class="alert alert-info">{{ \Session::get('message') }}</span>
						</div>
					</div>
					@endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"></th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												@foreach ($tasks as $task)
												<tr>
													<form action="{{ route('task.update') }}" method="post">
														@method('PUT')
														@csrf
														<td width="50"><a class="btn shadow-none" href="{{ route('task.complete', $task->id) }}"><input style="pointer-events: none" class="form-check-input" type="checkbox" {{ $task->status == '1' ? 'checked' : '' }}></a></td>
														<td><input name="title" class="form-control form-control-sm border-0 shadow-none p-0" style="background: transparent;" value="{{ $task->title }}" required></td>
														<td><input name="description" class="form-control form-control-sm border-0 shadow-none p-0" style="background: transparent;" value="{{ $task->description }}" required></td>
														<td width="120">
															<div class="d-flex flex-row justify-content-around align-items-center">
																<input type="hidden" name="id" value="{{ $task->id }}">
																<button type="submit" class="btn btn-sm btn-icon btn-secondary"><i class="fas fa-save me-2"></i>Save</button>
																<a class="btn btn-sm btn-icon btn-danger" href="{{ route('task.delete', $task->id) }}"><i class="fas fa-trash"></i></a>
															</div>
														</td>
													</form>
												</tr>
												@endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
@endsection