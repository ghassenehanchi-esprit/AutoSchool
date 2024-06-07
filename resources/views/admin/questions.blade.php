@extends('base2')

@section('content')
    <style>
        .pagination li.active span {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .pagination li a:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Questions List</h4>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question Text</th>
                                <th>Package Type</th>
                                <th>State</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{ $question->id }}</td>
                                    <td>{{ $question->text }}</td>
                                    <td>{{ $question->package->type }}</td>
                                    <td>{{ $question->package->state->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.questions.delete', $question) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Links -->
                    {{ $questions->links('vendor.pagination.bootstrap-4') }}

                </div>
            </div>
        </div>
    </div>
@endsection
