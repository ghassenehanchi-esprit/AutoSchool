@extends('base2')

@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"><style>
    .selected-states {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 10px;
    }

    .state-tag {
        display: inline-block;
        background-color: #007bff;
        color: white;
        border-radius: 15px;
        padding: 5px 10px;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .state-tag .remove-state {
        margin-left: 10px;
        cursor: pointer;
        background: none;
        border: none;
        color: white;
    }

</style>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select States
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($states as $state)
                        <a class="dropdown-item state-item" href="#" data-value="{{ $state->id }}">{{ $state->name }}</a>
                    @endforeach
                </div>
            </div>
            <div id="selected-states" class="selected-states mt-2"></div>
        </div>
        <input type="hidden" name="selected_states" id="selected_states_input">

        <div class="form-group">
            <label for="question_text">Question Text:</label>
            <input type="text" name="question_text" id="question_text" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="question_image">Question Image (optional):</label>
            <input type="file" name="question_image" id="question_image" class="form-control-file">
        </div>

        @for ($i = 1; $i <= 4; $i++)
            <div class="form-group">
                <label for="answer_text_{{ $i }}">Answer {{ $i }}:</label>
                <input type="text" name="answers[{{ $i }}][text]" id="answer_text_{{ $i }}" class="form-control" required>
                <input type="radio" name="correct_answer" value="{{ $i }}" id="correct_answer_{{ $i }}">
                <label for="correct_answer_{{ $i }}">Correct Answer</label>
            </div>
        @endfor

        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            let selectedStates = [];

            $('.state-item').click(function(e) {
                e.preventDefault();
                let stateId = $(this).data('value');
                let stateName = $(this).text();

                // Add or remove state from the array
                let index = selectedStates.indexOf(stateId);
                if (index === -1) {
                    selectedStates.push(stateId);
                    $('#selected-states').append('<span class="badge badge-primary mr-2">' + stateName + '<button type="button" class="close" aria-label="Close"><span aria-hidden="true" data-value="' + stateId + '">&times;</span></button></span>');
                } else {
                    selectedStates.splice(index, 1);
                    $('#selected-states span').filter(function() {
                        return $(this).text().trim() === stateName;
                    }).remove();
                }

                // Update the hidden input with the selected states
                $('#selected_states_input').val(selectedStates.join(','));
            });

            $(document).on('click', '.close', function() {
                let stateId = $(this).find('span').data('value');
                selectedStates.splice(selectedStates.indexOf(stateId), 1);
                $(this).parent().remove();

                // Update the hidden input with the selected states
                $('#selected_states_input').val(selectedStates.join(','));
            });
        });
    </script>
@endsection
