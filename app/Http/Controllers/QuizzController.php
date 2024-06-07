<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Question;
use App\Models\QuizDetails;
use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizzController extends Controller
{
    public function show($id)
    {
        // Fetch the quiz with the given ID
        $quiz = Quizz::find($id);

        $totalQuestions = $quiz->quizDetails->count();

        // Pass the quiz data and total number of questions to the view
        return view('quizz.index', compact('quiz', 'totalQuestions'));
    }
    public function create($orderId)
    {
        // Find the order by ID and retrieve the related package
        $order = Order::find($orderId);

        // Check if the order exists and has a related package
        if (!$order || !$order->package) {
            abort(404, 'Order or package not found.');
        }

        // Select 4 questions that belong to the package
        $questions = Question::where('package_id', $order->package->id)->inRandomOrder()->take(4)->get();

        // Create a new quiz instance and set the order_id
        $quiz = new Quizz();
        $quiz->order_id = $order->id; // Set the order_id from the route parameter
        $quiz->quizz_status = 0; // Status 0 indicates that the quiz has not been completed yet
        $quiz->quizz_score = 0; // Initial score is 0
        $quiz->created_at = now(); // Set the start date as the current date
        $quiz->user_id = Auth::id();
        $quiz->save();

        // Create quiz details for each question and attach them to the quiz
        foreach ($questions as $question) {
            $quizDetail = new QuizDetails();
            $quizDetail->quizz_id = $quiz->id;
            $quizDetail->question_id = $question->id;
            $quizDetail->save();
        }

        // Redirect the user to the quiz view with the quiz ID
        return redirect()->route('quizz.show', ['id' => $quiz->id]);
    }

    public function updateQuizDetail(Request $request, $quiz_detail_id)
    {
        $validated = $request->validate([
            'answer_id' => 'required|exists:answers,id',
        ]);

        // Debugging: Check the validated data

        $quizDetail = QuizDetails::find($quiz_detail_id);
        if ($quizDetail) {
            $quizDetail->user_answer = $validated['answer_id'];
            $quizDetail->save();
        }

        // Return a success response (no need to redirect)
        return response()->json(['message' => 'Answer updated successfully']);
    }
    public function showResults($quizId)
    {
        // Get the quiz details and calculate the percentage score
        $quiz = Quizz::findOrFail($quizId);
        $percentageScore = calculateQuizScore($quizId); // Assuming you have the helper function
        $quiz->quizz_score=$percentageScore;
        $quiz->quizz_status=1;
        $quiz->save();
        return view('quizz.result', compact('quiz', 'percentageScore'));
    }
}
