<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Coursemap;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Yajra\DataTables\DataTables;

class AssignmentController extends Controller
{
   

    
    public function datatables()
    {
        $status=array(1,2,3,4);
        if ( auth('admin')->user()->role_id == 1 ){
            $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('updated_at', 'desc')->with('course','user','lob')->get();
        }else{
            $smeIdToFind=  Auth::guard('admin')->user()->id;
            $courseIds = Course::whereRaw("FIND_IN_SET($smeIdToFind, sme_id) > 0")->where('status', 1)->get('id');
            $datas = Coursemap::whereIn('course_id', $courseIds)->whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
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
                ->addColumn('assignment_file', function(Coursemap $data) {
                    return '<a href="'.asset('uploads/assignment/'.$data->assignment_file).'" target="_blank" class="py-9 w-100 "><i class="ph ph-download"></i> Download </a>';

                }) 
                ->addColumn('assign_sme', function(Coursemap $data) {
                    $selected_sme_id = explode(",",$data->course->sme_id);
                    $smes = Admin::whereIn('id', $selected_sme_id)->where('role_id',2)->get();   
                    $sme_option='<select  class="sme-select" data-id="'.$data->id.'"><option value="">Select SME</option>';
                    foreach ($smes as $key => $sme) {
                    $sme_option .= '<option value="'.$sme->id.'">'.$sme->name.'</option>';
                    }
                    $sme_option .='</select>';

                    return $sme_option;
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
                ->addColumn('action', function(Coursemap $data) {
                    // if (Auth::guard("admin")->user()->role_id == 1) {       
                    //     return '';
                    // }else{
                        return '<a href="'.route('assignment.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>';
                   // }
                }) 
                ->rawColumns(['assignment_assign','assign_sme','user_name','course_name','assignment_file','assignment_status','action'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
               
        
        return view('admin.assignment.index');

    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $data = Coursemap::findOrFail($id);
            return view('admin.assignment.edit', compact('data'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('assignment')->with('error', 'assignment not found');
        } catch (\Illuminate\Database\QueryException $e) {
            abort(500);
        } catch (\Exception $e) {
            abort(500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'status' => 'required',
            'smefile' => 'file|mimes:zip,pdf,docx,doc,xlsx|max:2048',

            // 'remark' => 'required',
        ]);
       
        $data = Coursemap::findOrFail($id);
           
        if($request->hasFile('smefile')){
            if( $data->assignment_sme_file){
            $assignmentSmePath = public_path('uploads/assignment/' . $data->assignment_sme_file);
            if (file_exists($assignmentSmePath)) {
                unlink($assignmentSmePath);
            }}
             $assignmentfile = $request->file('smefile');
             $assignmentName = time() . '.' . $assignmentfile->getClientOriginalExtension();
             $assignmentfile->move(public_path('uploads/assignment'), $assignmentName);
             $data->assignment_sme_file =$assignmentName;
        }

        $data->assignment_status = $request->input('status');
        $data->assignment_remark = $request->input('remark');
        $data->assignment_upload_date=date('Y-m-d');;     
        $data->update();
        return redirect()->back()->with('success','Update Successfully');
    }


    public function smeUpdate(Request $request)
    {

        $course = Coursemap::find($request->id);  // Find the user by ID
        if ($course) {
            $course->assignment_assign = $request->sme_id;  // Update status
            $course->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);


        
    }





}
