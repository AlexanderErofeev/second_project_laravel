@extends('master')
@section('content')
    @section('title') | Todos Listing @endsection

    <h1>Active todos</h1>

    <div class="row">
        <div class="col-xl-12 text-end">
            <a href="{{ route('todos.create') }}" class="btn btn-primary"> Add Todo </a>
        </div>
    </div>

    <div class="card my-3">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>

            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    {{ Session::get('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @elseif (Session::has('error'))
            <div class="alert alert-danger d-flex alert-dismissible align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    {{ Session::get('error') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <table class="table table-striped">
            <thead class="bg-secondary text-light">
            <tr >
                <th>Id</th>
                <th width="20%">Title</th>
                <th width="45%">Description</th>
                <th width="15%">Completed</th>
                <th width="20%">Action</th>
            <tr>
            </thead>

            <tbody>
            @forelse ($todos as $todo)
                <tr>
                    <td>{{ $todo->id }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ $todo->is_completed == 1 ? 'Yes' : 'No' }}</td>
                    <td>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="post">
                            @csrf
                            <a href="{{ route('todos.show', $todo->id) }}" title="View" class="btn btn-sm btn-info">
                                View
                            </a>
                            <a href="{{ route('todos.edit', $todo->id) }}" title="Edit" class="btn btn-sm btn-success">
                                Edit </a>

                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?');" title="Delete" class="btn btn-sm btn-danger"> Delete </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <p class="text-danger text-center fw-bold"> No todos found! </p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <h1>Deleted todos</h1>

{{--    <div class="row">--}}
{{--        <div class="col-xl-12 text-end">--}}
{{--            <a href="{{ route('todos.create') }}" class="btn btn-primary"> Add Todo </a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card my-3">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>

            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    {{ Session::get('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @elseif (Session::has('error'))
            <div class="alert alert-danger d-flex alert-dismissible align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    {{ Session::get('error') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <table class="table table-striped">
            <thead class="bg-secondary text-light">
            <tr >
                <th>Id</th>
                <th width="20%">Title</th>
                <th width="45%">Description</th>
                <th width="15%">Completed</th>
                <th width="20%">Action</th>
            <tr>
            </thead>

            <tbody>
            @forelse ($deleted_todos as $todo)
                <tr>
                    <td>{{ $todo->id }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ $todo->is_completed == 1 ? 'Yes' : 'No' }}</td>
                    <td>
                            <a href="{{ route('todos.restore', $todo->id) }}" title="Restore" class="btn btn-sm btn-danger">
                                Restore
                            </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <p class="text-danger text-center fw-bold"> No todos found! </p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
