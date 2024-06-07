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

        /* Hover Effect for Answer Options */
        .answer-option:hover {
            background-color: #E6F2FF;
            transform: translateY(-5px);
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

        /* Utility Classes */
        .hidden {
            display: none;
        }
    </style>

    <div class="quiz-container">
        @foreach($quiz->quizDetails as $index => $detail)
            <div class="question-container {{ $index === 0 ? '' : 'hidden' }}" id="question-container-{{ $detail->id }}">
                <div class="question">
                    <strong>Question {{ $index + 1 }}:</strong>
                    <p>{{ $detail->question->text }}</p>
                </div>
                <div class="answers">
                    <form method="POST" class="answer-form" name="form">
                        @csrf
                        @foreach($detail->question->answers as $answer)
                            <div class="answer-option" data-answer-id="{{ $answer->id }}">
                                <label>{{ $answer->text }}</label>
                            </div>
                        @endforeach
                        <input type="hidden" name="answer_id" value="">
                        <input type="hidden" name="quiz_detail_id" value="{{ $detail->id }}">
                    </form>
                </div>
            </div>
        @endforeach
        <div class="navigation-buttons">
            <button class="btn-prev" onclick="navigate(-1)">Previous</button>
            <button   onclick="navigate(1)" class="btn-next">Next</button>
            <button onclick="window.location.href='{{ route('quiz.results', ['quizId' => $quiz->id]) }}'" class="Result hidden">Get My Result</button>

        </div>
    </div>





    <script>
        function updateNavigationBubbles(index) {
            const bubbles = document.querySelectorAll('.quiz-bubbles .bubble');
            bubbles.forEach((bubble, i) => {
                bubble.classList.remove('current');
                if (i === index) {
                    bubble.classList.add('current');
                }
            });
        }
        function checkLastQuestion(index) {
            const resultElement = document.querySelector('.Result');
            const nextButton = document.querySelector('.btn-next');

            if (resultElement) {
                if (index === {{$totalQuestions}} -1) {
                    nextButton.classList.add('hidden') // Hide the 'Next' button
                    resultElement.classList.remove('hidden') // Show the 'Get My Results' button
                } else {
                    nextButton.classList.remove('hidden') // Show the 'Next' button
                    resultElement.classList.add('hidden') // Hide the 'Get My Results' button
                }
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const questionContainers = document.querySelectorAll('.question-container');
            let currentQuestionIndex = 0;
            const totalQuestions = questionContainers.length;

            // Function to handle answer selection
            function handleAnswerClick(answerOption, form) {
                // Deselect all other options
                form.querySelectorAll('.answer-option').forEach(function(option) {
                    option.classList.remove('selected');
                });

                // Select the clicked option
                answerOption.classList.add('selected');

                // Set the hidden input value to the selected answer ID
                const answerId = answerOption.getAttribute('data-answer-id');
                console.log('Selected answer ID:', answerId); // Log the answer ID to the console
                form.querySelector('input[name="answer_id"]').value = answerId;

                // Prepare the form data for the Axios POST request
                const formData = new FormData(form);

                // Get the quiz_detail_id from the hidden input field
                const quizDetailId = form.querySelector('input[name="quiz_detail_id"]').value;

                // Set the post URL
                const postUrl = `/quiz/update-answer/${quizDetailId}`; // Update URL to include quiz_detail_id

                // Show the loading spinner

                // Submit the form data using Axios
                axios.post(postUrl, formData)
                    .then(function(response) {
                        console.log(response.data.message);
                        // Navigate to the next question
                        // Navigate to the next question
                        if (currentQuestionIndex < questionContainers.length - 1) {
                            questionContainers[currentQuestionIndex].classList.add('hidden');
                            questionContainers[++currentQuestionIndex].classList.remove('hidden');
                            updateNavigationBubbles(currentQuestionIndex);  // Update navigation bubbles
                        }
                    })
                    .catch(function(error) {
                        console.error(error.response.data); // Log any validation errors
                    })
                    .finally(function() {
                        // Hide the loading spinner
                        document.getElementById('loading-spinner').style.display = 'none';
                    });
            }

            // Add click event listeners to answer options
            questionContainers.forEach(container => {
                const answers = container.querySelectorAll('.answer-option');
                const form = container.querySelector('.answer-form');

                answers.forEach(answer => {
                    answer.addEventListener('click', function() {
                        handleAnswerClick(this, form);
                    });
                });
            });

// Handle form submission
            document.querySelectorAll('.answer-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const quizDetailId = this.querySelector('input[name="quiz_detail_id"]').value;
                    const selectedAnswerId = this.querySelector('input[name="answer_id"]').value;

                    if (!selectedAnswerId) {
                        alert('Please select an answer.');
                        return;
                    }

                    const formData = new FormData(this);
                    formData.append('answer_id', selectedAnswerId);
                    const postUrl = `/quiz/update-answer/${quizDetailId}`; // Updated URL to include quiz_detail_id
                    // Submit the form data using Axios
                    axios.post(postUrl, formData)
                        .then(function(response) {
                            console.log(response.data.message);
                            // Navigate to the next question
                            if (currentQuestionIndex < questionContainers.length - 1) {
                                questionContainers[currentQuestionIndex].classList.add('hidden');
                                questionContainers[++currentQuestionIndex].classList.remove('hidden');

                            }
                        })
                        .catch(function(error) {
                            console.error(error.response.data); // Log any validation errors
                        });
                });
            });

            // Function to navigate between questions
            window.navigate = function(step) {
                const newIndex = currentQuestionIndex + step;
                if (newIndex >= 0 && newIndex < questionContainers.length) {
                    questionContainers[currentQuestionIndex].classList.add('hidden');
                    questionContainers[newIndex].classList.remove('hidden');
                    const bubbles = document.querySelectorAll('.quiz-bubbles .bubble');
                    bubbles.forEach((bubble, i) => {
                        bubble.classList.remove('current');
                        if (i === newIndex) {
                            bubble.classList.add('current');
                        } else if (i !== newIndex) {
                            bubble.classList.remove('current');

                        }
                    });
                    currentQuestionIndex = newIndex;
                    checkLastQuestion(currentQuestionIndex)
                }
            };
        });




    </script>




    <!-- Remove this line if you're not using Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


@endsection
