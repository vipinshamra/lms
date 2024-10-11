@extends('layouts.user')
@section('content')

        
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Course Details</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 <div class="row gy-4">
    <div class="col-md-8">
        <!-- Course Card Start -->
        <div class="card">
            <div class="card-body p-lg-20 p-sm-3">
                <div class="flex-between flex-wrap gap-12 mb-20">
                    <div>
                        <h3 class="mb-4">{{ $lesson->module_name }} </h3>
                    </div>
                </div>
                <div class="rounded-16 overflow-hidden">
                    @if($module_type =='')
                        @if($lesson->video!='')
                        <video id="player" class="player" playsinline controls data-poster="assets/images/thumbs/course-details.png">
                            <source src="{{ asset('uploads/videos/'.$lesson->video) }}" type="video/mp4">
                            <source src="{{ asset('uploads/videos/'.$lesson->video) }}" type="video/webm">
                        </video>
                        @elseif ($lesson->document!='')
                        <iframe src=" {{ asset('uploads/docs/'.$lesson->document) }}" frameborder="0" width="100%" height="500" ></iframe>
                        @endif
                    @else
                        @if($module_type=='video')
                        <video id="player" class="player" playsinline controls data-poster="assets/images/thumbs/course-details.png">
                            <source src="{{ asset('uploads/videos/'.$lesson->video) }}" type="video/mp4">
                            <source src="{{ asset('uploads/videos/'.$lesson->video) }}" type="video/webm">
                        </video>
                        @elseif ($module_type=='document')
                        <iframe src=" {{ asset('uploads/docs/'.$lesson->document) }}" frameborder="0" width="100%" height="500" ></iframe>
                        @endif
                    @endif


                </div>
                
                <div class="mt-24">
                    <div class="mb-24 pb-24 border-bottom border-gray-100">
                        <h5 class="mb-12 fw-bold">About this course</h5>
                        <p class="text-gray-300 text-15">{{ $details->course->description }}</p>
                    </div>
                    <div class="">
                        <h5 class="mb-12 fw-bold">Description</h5>
                        <p class="text-gray-300 text-15"> {{ $lesson->description }}</p>
                    </div>
                      
                </div>
            </div>
        </div>
        <!-- Course Card End -->
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body p-0">
                @foreach ($details->course->module as $key=> $module)
               
                <div class="course-item">
                    <button type="button" class="course-item__button {{ $key==0?'active':'' }} flex-align gap-4 w-100 p-16 border-bottom border-gray-100">
                        <span class="d-block text-start">
                            <span class="d-block h5 mb-0 text-line-1">{{ $module->module_name }}</span>
                            <span class="d-block text-15 text-gray-300">{{ $module->duration }} min</span>
                        </span>
                        <span class="course-item__arrow ms-auto text-20 text-gray-500"><i class="ph ph-arrow-right"></i></span>
                    </button>
                    <div class="course-item-dropdown {{ $key==0?'active':'' }} border-bottom border-gray-100">
                        <ul class="course-list p-16 pb-0">
                            @if ($module->video !='')
                            <li class="course-list__item flex-align gap-8 mb-16 {{ $key==0?'active':'' }}">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.course.module',['id1' => $details->course->id,'slug'=>'video', 'id2' => $module->id]) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                        <i class="ph-fill ph-video"></i> Video
                                    </a>
                                </div>
                            </li>
                            @endif
                            @if ($module->document !='')
                            <li class="course-list__item flex-align gap-8 mb-16">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.course.module',['id1' => $details->course->id, 'slug'=>'document',  'id2' => $module->id]) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                        <i class="ph-fill ph-file"></i> Document
                                    </a>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endforeach
                @if ($details->course->quiz)
                <div class="course-item">
                    <button type="button" class="course-item__button flex-align gap-4 w-100 p-16 border-bottom border-gray-100">
                        <span class="d-block text-start">
                            <span class="d-block h5 mb-0 text-line-1">Quiz</span>
                            <span class="d-block text-15 text-gray-300">4.4 min</span>
                        </span>
                        <span class="course-item__arrow ms-auto text-20 text-gray-500"><i class="ph ph-arrow-right"></i></span>
                    </button>
                    <div class="course-item-dropdown border-bottom border-gray-100">
                        <ul class="course-list p-16 pb-0">
                            <li class="course-list__item flex-align gap-8 mb-16">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.quiz.start',$details->course->id) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                        Quiz Start
                                    </a>
                                </div>
                            </li>
                            <li class="course-list__item flex-align gap-8 mb-16">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.quiz.result') }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                        Quiz Result
                                    </a>
                                </div>
                            </li>   
                        </ul>
                    </div>
                </div>
                @endif
                @if ($details->course->assignment !='')
                <div class="course-item">
                    <button type="button" class="course-item__button flex-align gap-4 w-100 p-16 border-bottom border-gray-100">
                        <span class="d-block text-start">
                            <span class="d-block h5 mb-0 text-line-1">Assignments</span>
                        </span>
                        <span class="course-item__arrow ms-auto text-20 text-gray-500"><i class="ph ph-arrow-right"></i></span>
                    </button>
                    <div class="course-item-dropdown border-bottom border-gray-100">
                        <ul class="course-list p-16 pb-0">
                            <li class="course-list__item flex-align gap-8 mb-16">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.assignments.download', $details->course->id) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                       Download Assignments
                                    </a>
                                </div>
                            </li>
                            <li class="course-list__item flex-align gap-8 mb-16">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.assignments') }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                        Upload Assignments
                                    </a>
                                </div>
                            </li>   
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>

        
    </div>
</div>
<!-- Course Tab End -->

</div>
   
@endsection