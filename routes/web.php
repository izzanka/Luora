<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\StatController;
use App\Http\Controllers\User\ShareController;
use App\Http\Controllers\User\AnswerController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\ContentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\QuestionController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\CheckAnswerController;
use App\Http\Controllers\Admin\CheckQuestionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>'HtmlMinifier'], function(){ 

    Auth::routes();

    Route::group(['middleware' => 'auth'],function(){

        Route::group(['middleware' => ['can:isAdmin']],function(){
            Route::prefix('admin')->group(function(){
                Route::name('admin.')->group(function(){
                    //question
                    Route::get('/questions/latest',[CheckQuestionController::class,'index'])->name('questions.latest');
                    Route::get('/questions/most-reported',[CheckQuestionController::class,'reported'])->name('questions.most-reported');
                    Route::get('/question/{question}/{status}',[CheckQuestionController::class,'update_status'])->name('question.status');
                
                    //answer
                    Route::get('/answers/latest',[CheckAnswerController::class,'index'])->name('answers.latest');
                    Route::get('/answers/most-reported',[CheckAnswerController::class,'reported'])->name('answers.most-reported');
                    Route::get('/answer/{answer}/{status}',[CheckAnswerController::class,'update_status'])->name('answer.status');
                });
            });
        });
    
        //home
        Route::get('/', [HomeController::class, 'index']);
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/search',[HomeController::class,'search'])->name('search');
    
        //setting
        Route::get('/settings',[SettingController::class,'index'])->name('settings.index');
        Route::put('/settings/password/{user}',[SettingController::class,'update_password'])->name('settings.password');
    
        //content
        Route::get('/content',[ContentController::class,'index'])->name('content.index');
        Route::get('/content/answers',[ContentController::class,'answers'])->name('content.answers.index');
        Route::get('/content/questions',[ContentController::class,'questions'])->name('content.questions.index');
    
        //answer
        Route::get('/answer',[AnswerController::class,'index'])->name('answer.index');
        Route::put('/answer/{answer}/update',[AnswerController::class,'update'])->name('answer.update');
        Route::get('/answer/{answer}/destroy',[AnswerController::class,'destroy'])->name('answer.destroy');
        Route::post('/{question:title_slug}/answer',[AnswerController::class,'store'])->name('answer.store');
        Route::get('/answer/{answer}/{vote}',[AnswerController::class,'vote'])->name('answer.vote');
        Route::post('/answer/{answer}/report',[AnswerController::class,'report'])->name('answer.report');
    
        //profile
        Route::get('/{user:name_slug}/follow',[ProfileController::class,'follow'])->name('follow');
        Route::get('/profile/{user:name_slug}/show',[ProfileController::class,'show'])->name('profile.show');
        Route::get('/profile/{user:name_slug}',[ProfileController::class,'index'])->name('profile.index');
        Route::put('/profile/{user:name_slug}/update/topics',[ProfileController::class,'update_topics'])->name('profile.topics.update');
        Route::put('/profile/{user:name_slug}/update/{profile}',[ProfileController::class,'update_profile'])->name('profile.update');
        Route::put('/profile/{user:name_slug}/update/credential/{credentials}',[ProfileController::class,'update_credentials'])->name('profile.credentials.update');
        Route::get('/profile/{user:name_slug}/destroy/credential/{credentials}',[ProfileController::class,'destroy_credentials'])->name('profile.credentials.destroy');
        Route::get('/profile/{user:name_slug}/topics',[ProfileController::class,'show_topics'])->name('profile.topics.show');
        Route::get('/profile/{user:name_slug}/questions',[ProfileController::class,'show_questions'])->name('profile.questions.show');
        Route::get('/profile/{user:name_slug}/answers',[ProfileController::class,'show_answers'])->name('profile.answers.show');
    
        //stats
        Route::get('/stats',[StatController::class,'index'])->name('stats.index');
        Route::get('/stats/show',[StatController::class,'getStats'])->name('stats.show');
    
        //question
        Route::post('/add-question',[QuestionController::class,'store'])->name('question.store');
        Route::get('/{question:title_slug}',[QuestionController::class,'show'])->name('question.show');
        Route::put('/{question:title_slug}/update',[QuestionController::class,'update'])->name('question.update');
        Route::get('/{question:title_slug}/destroy',[QuestionController::class,'destroy'])->name('question.destroy');
        Route::post('/{question:title_slug}/report',[QuestionController::class,'report'])->name('question.report');
    
        //comment
        Route::post('/comment/store',[CommentController::class,'store'])->name('comment.store');
        Route::post('/reply/store',[CommentController::class,'replyStore'])->name('reply.store');
    });
    
    Route::get('/auth/redirect/{provider}',[SocialiteController::class,'redirect']);
    Route::get('/auth/callback/{provider}',[SocialiteController::class,'callback']);
    
});
