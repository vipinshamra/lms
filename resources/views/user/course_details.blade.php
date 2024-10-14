@extends('layouts.user')
@section('content')
<style>
    iframe {
        width: 100%;
        height: 100vh;
        border: none;
    }
</style>
        
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
                        @php $module_type='video'; @endphp
                        <video id="player" class="player" playsinline controls data-poster="assets/images/thumbs/course-details.png">
                            <source src="{{ asset('uploads/videos/'.$lesson->video) }}" type="video/mp4">
                            <source src="{{ asset('uploads/videos/'.$lesson->video) }}" type="video/webm">
                        </video>
                        @elseif ($lesson->document!='')
                        @php $module_type='document'; @endphp
                        <iframe id="pdfIframe" src=" {{ asset('uploads/docs/'.$lesson->document) }}#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" width="100%" height="500" ></iframe>
                        @endif
                    @else
                        @if($module_type=='video')
                        <video id="player" class="player" playsinline controls data-poster="assets/images/thumbs/course-details.png">
                            <source src="{{ asset('uploads/videos/'.$lesson->video) }}" type="video/mp4">
                            <source src="{{ asset('uploads/videos/'.$lesson->video) }}" type="video/webm">
                        </video>
                        @elseif ($module_type=='document')
                        <iframe id="pdfIframe" src=" {{ asset('uploads/docs/'.$lesson->document) }}#toolbar=0&navpanes=0&scrollbar=0" frameborder="0" width="100%" height="500" ></iframe>
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
             
                @php
                    $is_read_docs = explode(",",$details->is_read_docs);
                    $is_read_video = explode(",",$details->is_read_video);
                @endphp
                @foreach ($details->course->module as $key=> $module)
                @php
                        if($module_id==''){
                            $module_id = $module->id;
                        }
                @endphp
                <div class="course-item">
                    <button type="button" class="course-item__button {{ $module->id == $module_id ?'active':'' }} flex-align gap-4 w-100 p-16 border-bottom border-gray-100">
                        <span class="d-block text-start">
                            <span class="d-block h5 mb-0 text-line-1">{{ $module->module_name }}</span>
                            <span class="d-block text-15 text-gray-300">{{ $module->duration }} min</span>
                        </span>
                        <span class="course-item__arrow ms-auto text-20 text-gray-500"><i class="ph ph-arrow-right"></i></span>
                    </button>
                    <div class="course-item-dropdown {{ $module->id == $module_id?'active':'' }} border-bottom border-gray-100">
                        <ul class="course-list p-16 pb-0">
                            @if ($module->video !='')
                            <li class="course-list__item flex-align gap-8 mb-16 {{ in_array( $module->id, $is_read_video)?'active':'' }}">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.course.module',['id1' => $details->course->id,'slug'=>'video', 'id2' => $module->id]) }}" class="{{ ($module->id == $module_id && $module_type == 'video')?'text-decoration-underline':'text-gray-300' }} fw-medium d-block hover-text-main-600 d-lg-block">
                                        <i class="ph-fill ph-video"></i> Video
                                    </a>
                                </div>
                            </li>
                            @endif
                            @if ($module->document !='')
                            <li class="course-list__item flex-align gap-8 mb-16 {{ in_array( $module->id, $is_read_docs )?'active':'' }}">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.course.module',['id1' => $details->course->id, 'slug'=>'document',  'id2' => $module->id]) }}" class="{{ ($module->id == $module_id && $module_type == 'document')?'text-decoration-underline':'text-gray-300' }} fw-medium d-block hover-text-main-600 d-lg-block">
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
                            @if($details->quiz_status == 0 || $details->quiz_status == 2)
                           
                            <li class="course-list__item flex-align gap-8 mb-16">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    @if($details->quiz_status == 2)
                                    
                                    <a href="{{ route('quiz.retake',$details->course->id) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                        Quiz Retake
                                    </a>
                                    @else

                                    <a href="{{ route('quiz.index',$details->course->id) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                        Quiz Start
                                    </a>
                                    @endif

                                </div>
                            </li>
                            @endif

                            @if($details->quiz_status !=0)
                            <li class="course-list__item flex-align gap-8 mb-16 {{ $details->quiz_status == 1?'active':'' }}">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('quiz.result',$details->course->id) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                        Quiz Result
                                    </a>
                                </div>
                            </li> 
                            @endif
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
                            <li class="course-list__item flex-align gap-8 mb-16 {{ $details->assignment_download_status==1?'active':'' }}">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.assignments.download', $details->course->id) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                       Download Assignments
                                    </a>
                                </div>
                            </li>
                            @if ($details->assignment_status!=1)
                            <li class="course-list__item flex-align gap-8 mb-16">
                                <span class="circle flex-shrink-0 text-32 d-flex text-gray-100"><i class="ph ph-circle"></i></span>
                                <div class="w-100">
                                    <a href="{{ route('user.assignments', $details->course->id) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">

                                        @if ($details->assignment_status==2)
                                        In Review
                                        @elseif ($details->assignment_status==3)
                                        Upload Again
                                        @else
                                        Upload Assignments
                                        @endif 
                                    </a>
                                </div>
                            </li> 
                            @endif  
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

@section('scripts')

@if($module_type=='video')
<script>
    $(document).ready(function() {
    var video = document.getElementById('player');

    video.addEventListener('ended', function() {
        // Video has finished playing
        updateVideoStatus();
    });
});


function updateVideoStatus() {
    
    $.ajax({
        type: 'POST',
        url: "{{ route('video.status', ['id1' => $details->course->id, 'id2' => $lesson->id]) }}",  // Add your route here
        data: {
            '_token': '{{ csrf_token() }}',
            'pdf_status': 'completed'
        },
        success: function(data) {
            console.log(' status updated successfully!');
        },
        error: function(xhr, status, error) {
            console.log('Error updating PDF status: ' + error);
        }
    });
}

</script>

@elseif ($module_type=='document')
<script>
    $('#pdfIframe').on('load', function () {
      
                 updatePdfStatus();

    });

    
// $(document).ready(function() {
//     $('#pdfIframe').on('scroll', function() {
//         // if ($(this).scrollTop() + $(this).height() >= $(this)[0].scrollHeight) {
//             console.log('ok');
//             // User has scrolled to the bottom of the PDF
//         //     updatePdfStatus();
//         // }
//     });
// });

function updatePdfStatus() {
    
    $.ajax({
        type: 'POST',
        url: "{{ route('pdf.status', ['id1' => $details->course->id, 'id2' => $lesson->id]) }}",  // Add your route here
        data: {
            '_token': '{{ csrf_token() }}',
            'pdf_status': 'completed'
        },
        success: function(data) {
            console.log('status updated successfully!');
        },
        error: function(xhr, status, error) {
            console.log('Error updating PDF status: ' + error);
        }
    });
}

</script>

@endif


@endsection


   {{ $lesson->id }}
   {{ $details->course->id }}
@endsection