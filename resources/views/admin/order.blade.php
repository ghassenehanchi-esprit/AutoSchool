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
                    <h4 class="card-title">Orders List</h4>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Package Type</th>
                                <th>State</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->package->type }}</td>
                                    <td>{{ $order->package->state->name }}</td>
                                    <td>{{ $order->package->price }}</td>
                                    <td>
                                        <!-- Add action buttons here -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Links -->
                    {{ $orders->links('vendor.pagination.bootstrap-4') }}

                </div>
            </div>
        </div>
    </div>
@endsection
