<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;

Auth::routes();

Route::get('/symlink', function () {
    Artisan::call('storage:link');
    return 'The storage link has been created.';
})->name('storage.link');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('loginform');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/', [SiteController::class, 'showWelcome'])->name('welcome');
Route::middleware(['auth:user'])->group(function () {
    Route::get('/quizzes/{id}', [\App\Http\Controllers\QuizzController::class, 'show'])->name('quizz.show');
    Route::get('/quiz/{quizId}/results', [\App\Http\Controllers\QuizzController::class, 'showResults'])->name('quiz.results');
    Route::get('/payment/{id}', [\App\Http\Controllers\PaymentController::class, 'showPayment'])->name('stripe.payment.show');
    Route::get('/profile', [\App\Http\Controllers\PackageController::class, 'showProfile'])->name('profile.show');
    Route::get('/quiz/{orderId}', [\App\Http\Controllers\QuizzController::class, 'create'])->name('quiz.create');

    Route::get('/payment/success/{id}', [\App\Http\Controllers\PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');
    Route::post('/quiz/update-answer/{quiz_detail_id}', [\App\Http\Controllers\QuizzController::class, 'updateQuizDetail'])->name('quiz.update');
});
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/{state}/{type}',[\App\Http\Controllers\PackageController::class, 'showPackageView'] )->name('packages.show');

Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/package/edit', [AdminController::class, 'editPackage'])->name('admin.package.edit');
    Route::patch('/packages/update-price', [AdminController::class, 'updatePrice'])->name('admin.packages.updatePrice');
    Route::post('/questions/store', [AdminController::class, 'storeQuestion'])->name('admin.questions.store');
    Route::get('/questions/create', [AdminController::class, 'createQuestion'])->name('admin.questions.create');

    Route::get('/user/show', [AdminController::class, 'show'])->name('admin.user');
    Route::get('/questions/show', [AdminController::class, 'showQuestions'])->name('admin.questions.show');
    Route::delete('/questions/{question}', [AdminController::class, 'deleteQuestion'])->name('admin.questions.delete');
    Route::get('/orders/show', [AdminController::class, 'showOrders'])->name('admin.orders');
    Route::get('/contacts/show', [ContactController::class, 'contactIndex'])->name('contact.index');

});


Route::get('/packages/state/{id}', [\App\Http\Controllers\PackageController::class, 'showStatePackages'])->name('state.packages.show');
