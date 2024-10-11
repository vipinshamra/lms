<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Lob;
use App\Models\Coursemap;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;

use Yajra\DataTables\DataTables;

class UserController extends Controller
{
   
    public function datatables()
    {
         $datas = User::orderBy('id', 'desc')->get();
         //--- Integrating This Collection Into Datatables

         return Datatables::of($datas)
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
                            ->addColumn('action', function(User $data) {
                                return '<a href="'.route('user.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>
                                        <a href="'.route('user.changepassword',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Change Password</a>';
 
                            }) 
                            ->rawColumns(['status','action'])         
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lobs = Lob::all();
        return view('admin.user.create',compact('lobs'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'candidate_id' => ['required','digits:6','numeric'],
            'name' => 'required',
            "email" => ["required","email",'unique:users'],
            'phone' => ['required','digits:10','numeric','unique:users'],
            'lob_id' => 'required',         
            'designation'=> 'required',
            'grade'=> 'required',
            'employment_type'=> 'required',
            'expectance_date'=> 'required',
            'actual_date'=> 'required',
            'recruiter'=> 'required',
            ],
            [
            'lob_id.required' => 'Please select your LOB.',
            ]
        );
        
        $pass=1234;
        $token=hash('sha256',time());

        $user = new User();
        $input = $request->all();

        $lobIdToFind = $input['lob_id']; // assume you want to find this ID
        $myCourses = Course::whereRaw("FIND_IN_SET($lobIdToFind, lob_id) > 0")->where('status', 1)->get();

        if($myCourses){
            $input['password']=Hash::make($pass);
            $input['token']=$token;
            $input['offer_revoke']='';
            
            $input['status'] = 1;
            // print_r($input);die;
            $user->fill($input)->save();

            foreach($myCourses as $myCourse){
               
                $coursemap = new Coursemap();
                $coursemap->course_id = $myCourse->id;
                $coursemap->user_id = $user->id;
                $coursemap->lob_id= $lobIdToFind;
                $coursemap->assignment_file='';
                $coursemap->assignment_remark='';
                
                $coursemap->save();
            }

            return redirect()->back()->with('success','user create successfully');    
        }else{
            return redirect()->back()->with('error','Lob course not found');    
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $lobs = Lob::all();
            $user = User::findOrFail($id);
            return view('admin.user.edit', compact('user','lobs'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('user')->with('error', 'user not found');
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
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'phone' => 'required|numeric|digits:10|unique:users,phone,' . $id,
                'lob_id' => 'required',
                'designation'=> 'required',
                'grade'=> 'required',
                'employment_type'=> 'required',
                'expectance_date'=> 'required',
                'actual_date'=> 'required',
                'recruiter'=> 'required',
            ],
         [
            'lob_id.required' => 'Please select your LOB.',
            ]
        );

        $user = User::find($id);
        $input = $request->all();
        $user->update($input);

        return redirect()->back()->with('success','admin update successfully');
    }

    public function updateStatus($id,$status){

            // Update the status
            $user = User::find($id);
            $user->status = $status;
            $user->update();

            // Return a success message
            return redirect()->back()->with('success','Status updated successfully!');    

    
    }


    public function changepassword($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.user.changepassword', compact('user'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('user')->with('error', 'user not found');
        } catch (\Illuminate\Database\QueryException $e) {
            abort(500);
        } catch (\Exception $e) {
            abort(500);
        }

   
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatepassword(Request $request, $id)
    {
        $validatedData = $request->validate([
            'password' => 'required',
             "confirm_password" => ["required","same:password"],
        ]
        );

 
        $user = User::find($id);
        $user->password=Hash::make($request->input('password'));
        $user->update();
        // Return a success message
        return redirect()->back()->with('success','password updated successfully!');    

    }



}
