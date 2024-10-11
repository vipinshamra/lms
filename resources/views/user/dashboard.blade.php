@extends('layouts.user')
@section('content')

        
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Student Courses</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 <div class="card">
    <div class="card-body">
       
        <div class="row g-20">
            @foreach ($myCourses as $myCourse)
            
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="card border border-gray-100">
                    <div class="card-body p-8">
                        <a href="course-details.html" class="bg-main-100 rounded-8 overflow-hidden text-center mb-8 h-164 flex-center p-8">
                            <img src="{{  asset('uploads/thumb/'.$myCourse->course->image) }}" alt="Course Image">
                        </a>
                        <div class="p-8">
                            <h5 class="mb-0"><a href="course-details.html" class="hover-text-main-600">{{ $myCourse->course->course_name }}</a></h5>
                             <div class="flex-align gap-8 mt-12">
                                <span class="text-main-600 flex-shrink-0 text-13 fw-medium">32%</span>
                                <div class="progress w-100  bg-main-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-600 rounded-pill" style="width: 32%"></div>
                                </div>
                            </div>
                            <a href="{{ route('user.course',$myCourse->course->id) }}" class="btn btn-outline-main rounded-pill py-9 w-100 mt-24">Continue Watching</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
     
    </div>
</div>
<!-- Course Tab End -->

</div>
   
@endsection