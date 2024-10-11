<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Coursemap;
use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Module;
// use App\Mail\Websitemail;

use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
   
    public function dashboard(){
        
      $user_id=  Auth::guard('web')->user()->id;
        $myCourses = Coursemap::where('user_id', $user_id)->with('course')->get();
        
        return view("user.dashboard",compact('myCourses'));
    }

    public function course($course_id,$module_type='',$module_id=''){

        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
        if($module_id!=''){
        $lesson = Module::where('course_id', $course_id)->where('id', $module_id)->first();
        }else{
        $lesson = Module::where('course_id', $course_id)->first();
        }
        if($details && $lesson){
            //  dd($lesson->video);
            return view("user.course_details",compact('module_type','details','lesson'));

        } else {
            return redirect()->back()->with('error', 'not found');
        } 
    }

    

    public function quiz_start($course_id){
        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
    
        if($details){
        $quizes = Quiz::where('course_id', $course_id)->get();
        return view("user.quiz_form",compact('details','quizes'));
        }else {
            return redirect()->back()->with('error', 'not found');
        } 
    }

    public function getquestion($course_id){
       
        $quizQuestions = Quiz::where('course_id', $course_id)->get();
        
        $quizQuestionsArray = [];

        foreach ($quizQuestions as $question) {
            $quizQuestionsArray[] = [
                'id' => $question->id,
                'question' => $question->question,
                'options' => [
                    $question->option_a,
                    $question->option_b,
                    $question->option_c,
                    $question->option_d,
                ]
                // 'correct_answer' => $question->correct_answer,
            ];
        }

        return response()->json($quizQuestionsArray);

    }

    public function quiz_result(){
        return view("user.quiz_result");
    }

    public function assignments(){
        return view("user.assignments");
    }

    public function assignments_download($course_id){
            $user_id=  Auth::guard('web')->user()->id;
            $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();

            $url = public_path('uploads/assignment/'.$details->course->assignment);
            $filename = $details->course->course_name.'-assignment-'.$details->course->assignment;

            return Response::download($url, $filename);

    }
    public function assignments_upload(Request $request){
        $request->validate(rules: [
            'assinments' => 'required|file',
        ]);

        return redirect()->back()->with('success','update successfully');

    }
}
