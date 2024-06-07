@extends('layouts.app')

@section('content')
    <style>
        /* Importing Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        /* Quiz Container Styles */
        .quiz-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #F4F8FC;
            border: 1px solid #28527A;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Roboto', sans-serif;
        }

        /* Question Styles */
        .question {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Answer Option Styles */
        .answer-option {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #fff;
            border: 2px solid #28527A;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Selected Answer Styles */
        .answer-option.selected {
            background-color: #D1E7FD;
            border-color: #124d7c;
            font-weight: bold;
        }

        /* Navigation Buttons Styles */
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .Result,
        .btn-next,
        .btn-prev {
            padding: 10px 20px;
            background-color: #28527A;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .Result:hover,
        .btn-next:hover,
        .btn-prev:hover {
            background-color: #124d7c;
        }

        /* Circular Progress Styles */
        .circular-progress-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .circular-chart {
            width: 100px;
            height: 100px;
        }
        .circle-bg {
            fill: none;
            stroke: #eee;
            stroke-width: 2.8;
        }
        .circle {
            fill: none;
            stroke: #4db8ff;
            stroke-width: 2.8;
            transition: stroke-dasharray 0.3s ease;
        }
        .percentage {
            font-size: 16px;
            font-weight: bold;
            fill: #124d7c;
        }
        .correct-answer {
            border-color: green;
            color: green;
        }

        .incorrect-answer {
            border-color: red;
            color: red;
        }
    </style>

    <div class="quiz-container">
        <div class="navigation-buttons">
            <a href="{{ route('profile.show') }}" class="btn btn-primary">Go to Profile</a>
            <a href="{{ route('quiz.create', ['orderId' => $quiz->order->id]) }}" class="btn btn-primary">Retake Quiz</a>
        </div>
        <div class="circular-progress-container">
            <svg viewBox="0 0 36 36" class="circular-chart">
                <path class="circle-bg"
                      d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
                      fill="none" stroke="#eee" stroke-width="2.8" />

                <path class="circle"
                      stroke-dasharray="{{ $percentageScore }}, 100"
                      d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
                      fill="none" stroke="#4db8ff" stroke-width="2.8" />

                <text x="8" y="20.35" class="percentage" style="font-size: small">{{ $percentageScore }} %</text>
            </svg>
        </div>

        @foreach($quiz->quizDetails as $detail)
            <div class="question">
                {{ $detail->question->text }}
            </div>
            @foreach($detail->question->answers as $answer)
                <div class="answer-option
        {{ $detail->user_answer == $answer->id ? ($answer->is_correct ? 'correct-answer' : 'incorrect-answer') : ($answer->is_correct ? 'correct-answer' : '') }}">
                    {{ $answer->text }}
                </div>
    @endforeach

    @endforeach
    </div>
@endsection
