@extends('layouts.app')
@section('content')
<style>
    .grit.practice-test-card {
        background: #fbfcfc;
        box-shadow: 0 6px 10px rgba(33, 51, 63, .15);
        margin-top: 16px;
        padding: 24px;
        max-width: 300px;
    }

    .ace-light .grit.practice-test-card .review-buttons-wrapper>button {
        margin-right: 8px;
    }
    .grit.review-test-button {
        background: #fff;
        border: 2px solid #2689ca;
        border-radius: 6px;
        cursor: pointer;
        padding: 8px 24px;
    }
    [type=reset], [type=submit], body, button, html [type=button] {
        font-family: Nunito Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol;
    }
   .grit.button.solid.primary {
        background: #2689ca;
        border: 2px solid #2689ca;
        color: #fff;
    }
  .grit.button {
        align-items: center;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        min-height: 44px;
        padding: 8px 24px;
    }
    </style>



<div class="container mx-auto mt-10">
    <div class="flex flex-wrap justify-center gap-4">
        @foreach ($user->orders as $order)
            <div class="grit practice-test-card flex-1 min-w-[300px] border rounded-lg shadow-lg p-4">
                <h2 class="headings__h2">{{ $order->package->state->name }} Practice Test</h2>
                <span class="paragraph__condensed question-count">Questions per attempt: 100</span>
                <!-- Update this line -->
                <a href="{{ route('quiz.create', ['orderId' => $order->id]) }}" class="grit button controls__button-label solid primary mt-4">
                    <span class="children">Take a practice test</span>
                </a>
                <hr class="my-4">
                @foreach ($order->quizzes->where('quizz_status', 1) as $quiz)
                    <div class="quiz-result">
                        <h3 class="headings__h3">Test Results</h3>
                        <div class="review-buttons-wrapper">
                            <button class="grit review-test-button">
                                <h2 class="headings__h2" data-test="score">{{ $quiz->quizz_score }}%</h2>
                                <span class="time-since metadata__regular" data-test="timeSince">{{ $order->created_at->format('M d, Y') }}</span>
                            </button>
                            <a href="{{ route('quiz.results', ['quizId' => $quiz->id]) }}" class="btn btn-primary">View Results</a>
                        </div>
                    </div>
                @endforeach

            </div>
        @endforeach
    </div>
</div>




@endsection
