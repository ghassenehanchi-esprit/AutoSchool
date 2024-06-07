@extends('base2')

@section('content')

    <form action="{{ route('admin.packages.updatePrice') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="type">Package Type:</label>
            <select name="type" id="type" class="form-control">
                <option value="adult">Adult</option>
                <option value="teens">Teens</option>
                <option value="defensive">Defensive</option>
            </select>
        </div>

        <div class="form-group">
            <label for="state_id">State:</label>
            <select name="state_id" id="state_id" class="form-control">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="price">New Price:</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Price</button>
    </form>

@endsection
