<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Models\Order;
use App\Models\Package;
use App\Models\Question;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function show()
    {
        $users = User::all();

        return view('admin.users',compact('users'));
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth('admin')->attempt($credentials)) {
            // Authentication successful
            return redirect('/admin/user/show');
        } else {
            // Authentication failed
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
    public function editPackage()
    {
        $states = State::all(); // Assuming you have a State model that corresponds to your states table
        return view('admin.package', compact('states'));
    }
    public function updatePrice(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'state_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $package = Package::where('type', $validatedData['type'])
            ->where('state_id', $validatedData['state_id'])
            ->first();

        if ($package) {
            $package->update(['price' => $validatedData['price']]);
            return redirect()->back()->with('success', 'Package price updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Package not found.');
        }
    }

    public function storeQuestion(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'selected_states' => 'required|string',
            'question_text' => 'required|string',
            'question_image' => 'nullable|image',
            'answers' => 'required|array',
            'answers.*.text' => 'required|string',
            'correct_answer' => 'required|integer|min:1|max:4'
        ]);

        // Convert the selected states from string to array
        $stateIds = explode(',', $validatedData['selected_states']);

        foreach ($stateIds as $stateId) {
            // Find all packages that match the type and state
            $packages = Package::where('type', $validatedData['type'])
                ->where('state_id', $stateId)
                ->get();

            if ($packages->isEmpty()) {
                continue; // Skip if no packages found for the state
            }

            foreach ($packages as $package) {
                $question = new Question();
                $question->text = $validatedData['question_text'];
                $question->package_id = $package->id;

                if ($request->hasFile('question_image')) {
                    $image = $request->file('question_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->storeAs('public/questions', $imageName);
                    $question->image = $imageName; // Save only the image name
                }

                $question->save();

                foreach ($validatedData['answers'] as $key => $answer) {
                    $newAnswer = new Answer();
                    $newAnswer->text = $answer['text'];
                    $newAnswer->question_id = $question->id;
                    $newAnswer->is_correct = ($key == $validatedData['correct_answer']);
                    $newAnswer->save();
                }
            }
        }

        return back()->with('success', 'Question and answers added successfully for all matching packages');
    }
    public function showQuestions()
    {
        $questions = Question::paginate(5); // Adjust the number as needed for pagination
        return view('admin.questions', compact('questions'));
    }

    public function deleteQuestion(Question $question)
    {
        $question->delete();
        return back()->with('success', 'Question deleted successfully.');
    }
    public function showOrders()
    {
        $orders = Order::where('status', 1)->paginate(10); // Adjust the pagination as needed
        return view('admin.order', compact('orders'));
    }


    public function createQuestion()
    {
        $states = State::all(); // Retrieve all states from the database
        return view('admin.question_add', compact('states'));
    }



}
