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
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form id="form-create" action="{{ route('user.assignments.upload')}}" method="post"  class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf
            <div class="row gy-20">
            
                <div class="col-xxl-9 col-md-8 col-sm-7">
                    <div class="row g-20">
                        <div class="col-sm-12">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Assinments <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="file" name="assignment" class=" form-control py-11 pe-76 @error('assignment') is-invalid @enderror" >
                                @error('assignment') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                        </div>
                     
                    </div>
                </div>
                <div class="flex-align justify-content-end gap-8">
                    <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                    <button type="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                 </div>
            </div>
        </form>

    </div>
</div>
<!-- Course Tab End -->

</div>
   
@endsection