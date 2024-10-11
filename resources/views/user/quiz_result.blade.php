@extends('layouts.user')
@section('content')

        
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Upload Assinments</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 <div class="card">
    <div class="card-body">
       
        <form action="#">
            <div class="row gy-20">
            
                <div class="col-xxl-9 col-md-8 col-sm-7">
                    <div class="row g-20">
                        <div class="col-sm-12">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Assinments <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="file" class=" form-control py-11 pe-76" >
                            </div>
                        </div>
                     
                    </div>
                </div>
                <div class="flex-align justify-content-end gap-8">
                    <a href="mentor-courses.html" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                    <a href="upload-videos.html" class="btn btn-main rounded-pill py-9">Submit</a>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- Course Tab End -->

</div>
   
@endsection