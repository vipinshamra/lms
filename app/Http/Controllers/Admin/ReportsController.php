<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Lob;
use App\Models\Coursemap;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;


class ReportsController extends Controller
{
    
    public function assignmentExport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status=array(1,2,3,4);       
        if ($start_date && $end_date) {
            $datas = Coursemap::whereBetween('assignment_upload_date', [$start_date, $end_date])->whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        } else{
            $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        }
        // Prepare CSV content
        $csvContent = "User Name,Course Name,LOB,Assigned,Date,,Status\n"; // CSV header

        foreach ($datas as $data) {
            $smename=  ($data->sme)?$data->sme->name:'';
            $status='';
            if($data->assignment_status == 1){
            $status= 'Completed';
            }elseif($data->assignment_status == 2){
            $status= 'In Review' ;
            }elseif($data->assignment_status == 3){
            $status= 'Rework' ;
            }
            $csvContent .= "{$data->user->name},{$data->course->course_name},{$data->lob->name},{$smename},{$data->assignment_upload_date},{$status}\n"; // Custom CSV row
        }

        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="assignment.csv"',
        ]);
    }

    public function assignmentDatatables(Request $request)
    {
        $status=array(1,2,3,4);
        $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                ->addColumn('user_name', function(Coursemap $data) {
                    return $data->user->name;
                }) 

                ->addColumn('course_name', function(Coursemap $data) {
                    return $data->course->course_name;
                }) 
                
                ->addColumn('lob_id', function(Coursemap $data) {
                    return $data->lob->name;
                })   
                ->addColumn('assignment_assign', function(Coursemap $data) {
                    return ($data->sme)?$data->sme->name:'';
                })           
                ->addColumn('assignment_status', function(Coursemap $data) {
                
                    $alertmsg='';//"return confirm('Are you sure you want to update the status?')";
                    $status='';
                    if($data->assignment_status == 1){

                        $status= '<a href="#" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                            onclick="'.$alertmsg.'">
                            <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                            Completed
                            </a>';
                    }elseif($data->assignment_status == 2){
                    
                        $status= '<a href="#"  
                            class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                onclick="'.$alertmsg.'">
                            <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                            In Review
                            </a>' ;
                    }elseif($data->assignment_status == 3){
                            
                        $status= '<a href="#"  
                                class="text-13 py-2 px-8 bg-danger-50 text-danger-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-danger-600 rounded-circle flex-shrink-0"></span>
                                Rework
                                </a>' ;
                    }
                    return $status;
                }) 
                
                ->rawColumns(['assignment_assign','assign_sme','user_name','course_name','assignment_status'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }

    public function assignment()
    { 
        return view("admin.reports.assignment");
    }

    public function courseCompletionExport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status=array(1,2,3,4);       
        if ($start_date && $end_date) {
            $datas = Coursemap::whereBetween('assignment_upload_date', [$start_date, $end_date])->whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        } else{
            $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        }
        // Prepare CSV content
        $csvContent = "User Name,Course Name,LOB,Assigned,Date,,Status\n"; // CSV header

        foreach ($datas as $data) {
            $smename=  ($data->sme)?$data->sme->name:'';
            $status='';
            if($data->assignment_status == 1){
            $status= 'Completed';
            }elseif($data->assignment_status == 2){
            $status= 'In Review' ;
            }elseif($data->assignment_status == 3){
            $status= 'Rework' ;
            }
            $csvContent .= "{$data->user->name},{$data->course->course_name},{$data->lob->name},{$smename},{$data->assignment_upload_date},{$status}\n"; // Custom CSV row
        }

        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="course-completion.csv"',
        ]);
    }
    
    public function courseCompletionDatatables(Request $request)
    {
        $status=array(1,2,3,4);
         $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
         if ($request->filled('from_date') && $request->filled('to_date')) {
            $datas = $datas->whereBetween('assignment_upload_date', [$request->from_date, $request->to_date]);
        }
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                ->addColumn('user_name', function(Coursemap $data) {
                    return $data->user->name;
                }) 

                ->addColumn('course_name', function(Coursemap $data) {
                    return $data->course->course_name;
                }) 
                
                ->addColumn('lob_id', function(Coursemap $data) {
                    return $data->lob->name;
                })   
                ->addColumn('assignment_assign', function(Coursemap $data) {
                    return ($data->sme)?$data->sme->name:'';
                })           
                ->addColumn('assignment_status', function(Coursemap $data) {
                
                    $alertmsg='';//"return confirm('Are you sure you want to update the status?')";
                    $status='';
                    if($data->assignment_status == 1){

                        $status= '<a href="#" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                            onclick="'.$alertmsg.'">
                            <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                            Completed
                            </a>';
                    }elseif($data->assignment_status == 2){
                    
                        $status= '<a href="#"  
                            class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                onclick="'.$alertmsg.'">
                            <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                            In Review
                            </a>' ;
                    }elseif($data->assignment_status == 3){
                            
                        $status= '<a href="#"  
                                class="text-13 py-2 px-8 bg-danger-50 text-danger-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-danger-600 rounded-circle flex-shrink-0"></span>
                                Rework
                                </a>' ;
                    }
                    return $status;
                }) 
                
                ->rawColumns(['assignment_assign','assign_sme','user_name','course_name','assignment_status'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }

    public function courseCompletion()
    {
        //Course Completion & Inprogress report
        return view("admin.reports.course-completion");
    }

    public function userDetailsExport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if ($start_date && $end_date) {
            $datas = User::whereBetween('actual_date', [$start_date, $end_date])->orderBy('id', 'desc')->with('lob')->get();
        } else{
            $datas = User::orderBy('id', 'desc')->with('lob')->get();
        }
        // Prepare CSV content
        $csvContent = "User Id,User Name,Email Id,Sub LoB,Date Of Joining,Designation,Department,Grade,Status\n"; // CSV header
        foreach ($datas as $data) {
            $lobname=  ($data->lob)?$data->lob->name:'';
            
            if($data->assignment_status == 1){
            $status= 'Active';
            }else{
            $status= 'Inactive' ;
            }

            $csvContent .= "{$data->candidate_id},{$data->name},{$data->email},{$lobname},{$data->actual_date},{$data->designation},{$data->department},{$data->grade},{$status}\n"; // Custom CSV row
        }

        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="user-details.csv"',
        ]);
    }
    
    public function userDetailsDatatables(Request $request)
    {
        $datas = User::orderBy('id', 'desc')->with('lob')->get();
        //--- Integrating This Collection Into Datatables

        return Datatables::of($datas)
                            ->addColumn('lob_id', function(User $data) {
                                return $data->lob->name;
                            })   
                           ->addColumn('status', function(User $data) {
                               // $role = $data->role_id == 0 ? 'No Role' : $data->role->name;
                               $alertmsg="return confirm('Are you sure you want to update the status?')";

                               return ($data->status == 1)?

                           '  <a href="'.route('user.status.update',['id1' => $data->id, 'id2' => 0]).'" 
                           class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                   onclick="'.$alertmsg.'">
                               <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                               Active
                               </a>'
                               :
                               '<a href="'.route('user.status.update',['id1' => $data->id, 'id2' => 1]).'"  
                               class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                   onclick="'.$alertmsg.'">
                               <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                               Inactive
                               </a>'
                               ;
                           }) 
                           ->rawColumns(['status','lob_id'])         
                           ->toJson(); //--- Returning Json Data To Client Side
    }

    public function userDetails()
    {
        //User Details
        return view("admin.reports.user-details");
    }

    public function courseCatalogueExport(Request $request)
    {
        die();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status=array(1,2,3,4);       
        if ($start_date && $end_date) {
            $datas = Coursemap::whereBetween('created_at', [$start_date, $end_date])->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        } else{
            $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        }
        // Prepare CSV content
     
        $csvContent = "Course Name,Description,Module Duration,Is Active,Is Assessment Available,Total Modules,Created Date,IsApplicable To LoB Name";
        
        foreach ($datas as $data) {
            $module_duration = $data->course->module->sum('duration').'min';
            $total_modules = $data->course->module->count();
            $assignment = $data->assignment!=''?'yes':'No';
            $data->course->created_at;
            if($data->course->status == 1){
            $status= 'Active';
            }else{
            $status= 'Deactive</a>' ;
            } 
            $csvContent .= "{$data->course->course_name},{$data->course->description},{$module_duration},{$status},{$assignment },{$total_modules},{$data->course->created_at},{$data->lob->name}\n"; // Custom CSV row
        }

        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="course-catalogue.csv"',
        ]);
    }
    
    public function courseCatalogueDatatables(Request $request)
    {

        $datas = Coursemap::orderBy('created_at', 'desc')->with('course','user','lob')->get();   
         //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)      
                ->addColumn('course_name', function(Coursemap $data) {
                    return $data->course->course_name;
                }) 
                ->addColumn('description', function(Coursemap $data) {
                    return $data->course->description;
                }) 
                ->addColumn('module_duration', function(Coursemap $data) {
                    return $data->course->module->sum('duration').'min';
                }) 
                ->addColumn('total_modules', function(Coursemap $data) {
                    return $data->course->module->count();
                })   
                
                ->addColumn('is_assessment_available', function(Coursemap $data) {
                    return $data->assignment!=''?'yes':'No';
                }) 
                ->addColumn('uploader', function(Coursemap $data) {
                    return $data->course->uploader;
                })   
                ->addColumn('created_at', function(Coursemap $data) {
                    return $data->course->created_at;
                })  
                ->addColumn('lob_id', function(Coursemap $data) {
                    return $data->lob->name;
                })   
                      
                ->addColumn('is_active', function(Coursemap $data) {
                
                    $alertmsg='';//"return confirm('Are you sure you want to update the status?')";
                    if($data->course->status == 1){

                        $status= '<a href="#" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                            onclick="'.$alertmsg.'">
                            <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                            Active
                            </a>';
                    }else{
                        $status= '<a href="#"  
                                class="text-13 py-2 px-8 bg-danger-50 text-danger-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-danger-600 rounded-circle flex-shrink-0"></span>
                                Deactive
                                </a>' ;
                    }
                    return $status;
                }) 
                
                ->rawColumns(['uploader','course_name','description','module_duration','is_assessment_available','created_at','lob_id','is_active'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }

    public function courseCatalogue()
    {
        //Course Catalogue Report
        return view("admin.reports.course-catalogue");
    }

 

}
