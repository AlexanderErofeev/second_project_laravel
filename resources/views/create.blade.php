@extends('master')
@section('content')
    @section('title') | Create Todo @endsection

    <div class="row">
        <div class="col-xl-6 col-lg-8 mx-auto">
            <form action="{{ route('todos.store') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> Create Todo </h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group my-3">
                            <label for="title"> Title </label>
                            <input type="text" required name="title" id="title" class="form-control" placeholder="Title" />
                        </div>

                        <div class="form-group my-3">
                            <label for="description"> Description </label>
                            <textarea name="description" required id="description" class="form-control" placeholder="Description"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success"> Save </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
