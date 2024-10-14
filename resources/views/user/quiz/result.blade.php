@extends('layouts.user')
@section('content')

<style>
    #timer {
        font-size: 1.5rem;
        color: red;
    }
</style>    
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Quiz</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 <div class="card">
    <div class="card-body">
        <div class="mb-20 flex-between flex-wrap gap-8">
            <h3 class="mb-0"> {{ $coursedetails->course->course_name }} - Quiz Result</h3>
         
        </div>
       
        <div class="row gy-20">
            

            <div class="container mt-5">
                 
                    <div class="card">
                        <div class="card-body">

                            <p>Your score: {{ $score }} / 100</p>
                            @if ($coursedetails->quiz_status != 1)
                            <p><a href="{{ route('quiz.retake', $coursedetails->course->id) }}">Retake the quiz</a></p>  
                            @endif
                        </div>
                    </div>

                   

               
            </div>
  
        </div>

 


    </div>
</div>
<!-- Course Tab End -->

</div>
   

@endsection