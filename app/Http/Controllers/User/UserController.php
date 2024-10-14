<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Coursemap;
use App\Models\User;
use App\Models\Course;
use App\Models\QuizQuestion;
use App\Models\Module;
use App\Models\UserQuizAnswer;

// use App\Mail\Websitemail;

use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
   
    public function dashboard(){
        
        $user_id=  Auth::guard('web')->user()->id;
        $lobIdToFind=  Auth::guard('web')->user()->lob_id;
         

        $lobCourses = Course::whereRaw("FIND_IN_SET($lobIdToFind, lob_id) > 0")->where('status', 1)->get();
      
         if($lobCourses){
           
            foreach($lobCourses as $lobCourse){
               $checkCourse = Coursemap::where('course_id', $lobCourse->id)->where('user_id', $user_id)->first();
               if(!$checkCourse) { 
                    $coursemap = new Coursemap();
                    $coursemap->course_id = $lobCourse->id;
                    $coursemap->user_id = $user_id;
                    $coursemap->lob_id= $lobIdToFind;
                    $coursemap->assignment_file='';
                    $coursemap->assignment_remark='';     
                    $coursemap->save();
                }
            }

        }

        //  course_id lob_id user_id
        $myCourses = Coursemap::where('user_id', $user_id)->with('course')->get(); 
        return view("user.dashboard",compact('myCourses'));
    }

    public function course($course_id, $module_type='',$module_id=''){

        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
        if($module_id!=''){
        $lesson = Module::where('course_id', $course_id)->where('id', $module_id)->first();
        }else{
        $lesson = Module::where('course_id', $course_id)->first();
        }
        if($details && $lesson){
            //  dd($lesson->video);
            return view("user.course_details",compact('module_id','module_type','details','lesson'));

        } else {
            return redirect()->back()->with('error', 'not found');
        } 
    }

    public function assignments_download($course_id){
        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();

        if($details){

            $details->assignment_download_status = 1;
            $details->update();
            $url = public_path('uploads/assignment/'.$details->course->assignment);
            $filename = $details->course->course_name.'-assignment-'.$details->course->assignment;


            return Response::download($url, $filename);

         }
    }   

    public function assignments($course_id){
            $user_id=  Auth::guard('web')->user()->id;
            $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
          
           if($details){
                return view("user.assignments",compact('details'));
             }else {
                return redirect()->back()->with('error', 'not found');
            } 
    }

  
    public function assignments_upload(Request $request, $courseId){
        $request->validate( [
            'file' => 'required',
        ]);

        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
        if($details){

            if($request->hasFile('file')){
                if( $details->assignment_file!==''){
                    $imagePath = public_path('uploads/assignment/' .  $details->assignment_file);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);  // Remove the old image
                    }
                }
                $file = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/assignment'), $fileName);
                $details->assignment_file =$fileName;
                $details->assignment_status =2;//for review
                $details->update();

                return redirect()->back()->with('success','upload successfully');
            }else{
                return redirect()->back()->with('error', 'assignment not upload'); 
            }

        }else {
            return redirect()->back()->with('error', 'course found');
        } 



    }



    public function showQuiz($course_id,$questionindex=''){
            $user_id=  Auth::guard('web')->user()->id;
            $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
            $questionindex=0;
            if($details){
                if ($details->quiz_status == 1){
                    return redirect()->back()->with('error', 'not found');
                }
                $questionCount  = QuizQuestion::where('course_id', $course_id)->count();
                $question = QuizQuestion::where('course_id', $course_id)->orderBy('created_at', 'asc')->first();

                return view("user.quiz.index",compact('questionCount','questionindex','details','question'));
            }else {
                return redirect()->back()->with('error', 'not found');
            } 
    }

    public function showQuestion($courseId, $questionindex=0)
    {

        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
        if($details){
            $questionCount  = QuizQuestion::where('course_id', $courseId)->count();
          
            $questions = QuizQuestion::where('course_id', $courseId)->orderBy('created_at', 'asc')->get();

            if ($questionindex >= 0 && $questionindex < $questions->count()) {
                $question = $questions[$questionindex];
                // Now you can use $question
            } else{
                return redirect()->back()->with('error', 'not found');
            }
          
            return view('user.quiz.index', compact('questionCount','questionindex','details', 'question'));
        }else {
            return redirect()->back()->with('error', 'not found');
        } 
    }

    public function storeAnswer(Request $request, $courseId, $questionId)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        UserQuizAnswer::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'course_id'=>$courseId,
                'question_id' => $questionId,
            ],
            ['answer' => $request->input('answer')]
        );
        $questionindex =$request->input('questionindex');
        if ($questionindex != 0) {
            return redirect()->route('quiz.question', [$courseId, $questionindex]);
        } else {

            return redirect()->route('quiz.result', $courseId);
        }
    }

    public function showResult($courseId)
    {

        $user_id=  Auth::guard('web')->user()->id;
        $coursedetails = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
        if($coursedetails){
            $questions = QuizQuestion::where('course_id', $courseId)->get();
            $userAnswers = UserQuizAnswer::where('user_id', auth()->id())->where('course_id', $courseId)->with('questions')->get();
            $score = 0;
            foreach ($userAnswers as $userAnswer) {
                if ($userAnswer->answer == $userAnswer->questions->correct_answer) {
                    $score++;
                }
            }
            $scorePercentage=($score *100) / $questions->count();
            if($scorePercentage >= 80){
                $coursedetails->quiz_status = 1;
                $coursedetails->update();
            }else{
                $coursedetails->quiz_status = 2;
                $coursedetails->update();
            }

            return view('user.quiz.result', compact('questions','coursedetails', 'score'));
        }else {
            return redirect()->back()->with('error', 'not found');
        } 
    }

    public function retakeQuiz($courseId)
    {
        $user_id=  Auth::guard('web')->user()->id;
        $coursedetails = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
        if($coursedetails){
            if ($coursedetails->quiz_status != 1){
                UserQuizAnswer::where('user_id', auth()->id())->where('course_id', $courseId)->delete();
                return redirect()->route('quiz.index', $courseId);
            }else {
                return redirect()->back()->with('error', 'not found');
            } 
        }else {
            return redirect()->back()->with('error', 'not found');
        } 
       
    }


    public function updatePdfReadStatus(Request $request,$course_id,$module_id){
        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();

        if ($details) {
            $is_read_docs = ($details->is_read_docs!='')?explode(",",$details->is_read_docs):array();
            $is_read_docs[]=$module_id;

            $details->is_read_docs = implode(',',array_unique($is_read_docs));
            $details->save();

            return response()->json(['message' => 'Status updated successfully']);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
    public function updateVideoReadStatus(Request $request,$course_id,$module_id){
        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();

        if ($details) {
            $is_read_video = ($details->is_read_video!='')?explode(",",$details->is_read_video):array();
            $is_read_video[]=$module_id;

            $details->is_read_video = implode(',',array_unique($is_read_video));
            $details->save();

            return response()->json(['message' => 'Status updated successfully']);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

}
