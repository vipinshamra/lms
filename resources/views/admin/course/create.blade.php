@extends('layouts.lms')
@section('content')

<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">Course</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
                 
                <!-- Create Course Step List Start -->
                <ul class="step-list mb-24">
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6  active">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span> 
                        Course Details
                        <span class="line position-relative"></span>
                    </li>
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6  ">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span> 
                          Create Quiz
                        <span class="line position-relative"></span>
                    </li>
                    <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6  ">
                        <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span> 
                        Upload Module
                        <span class="line position-relative"></span>
                    </li>
                    
                </ul>
                <!-- Create Course Step List End -->
            

    <div class="card">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Create New Course</h5>        
            <button type="button" class="text-main-600 text-md d-flex" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Course Details">
                <i class="ph-fill ph-question"></i>
            </button>
        </div>
        <div class="card-body">
            
            @include('includes.validation-error')


            <form id="form-create" action="{{ route('course.store')}}" method="post"  class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <div class="row gy-20">
                    <div class="col-xxl-3 col-md-4 col-sm-5">
                        <div class="mb-20">
                            <label class="h5 fw-semibold font-heading mb-0">Thumbnail Image <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                        </div>
                        {{-- <input type="file" name="image"> --}}

                        <div id="fileUpload" class="fileUpload image-upload"></div>
                        @error('image') <div class="invalid">{{ $message }}</div> @enderror  

                    </div>
                    <div class="col-xxl-9 col-md-8 col-sm-7">
                        <div class="row g-20">
                            <div class="col-sm-12">
                                <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Course Name <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                <div class="position-relative">
                                    <input type="text" class="text-counter placeholder-13 form-control py-11 pe-76 @error('course_name') is-invalid @enderror" value="{{ old('course_name', '') }}"  name="course_name" maxlength="100" id="courseTitle" placeholder="Name of the Lesson">
                                    <div class="text-gray-400 position-absolute inset-inline-end-0 top-50 translate-middle-y me-16">
                                        <span id="current">10</span>
                                        <span id="maximum">/ 100</span>
                                    </div>
                                    @error('course_name') <div class="invalid-feedback">{{ $message }}</div> @enderror  

                                </div>
                            </div>
                                                     
                            <div class="col-sm-12">
                                <label for="fname" class="form-label mb-8 h6">Description <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                <textarea  class="form-control py-11 @error('description') is-invalid @enderror"   name="description" id="fname" placeholder="Enter Description"> {{ old('description', '') }} </textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                            <div class="col-sm-12">
                                <label for="sme_id" class="form-label mb-8 h6">SME <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                <select class="form-control select2 form-select py-11 @error('sme_id') is-invalid @enderror" required name="sme_id[]" data-placeholder="Choose SME" multiple>
                                    
                                    <option value="">{{ __('Select SME') }}</option>
                                    @foreach($smes as $sme)
                                      <option  value="{{ $sme->id }}">{{ $sme->name }}</option>
                                    @endforeach
                                </select>

                                </select>
                                @error('sme_id') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                           
                            <div class="col-sm-12">
                                <label for="lob" class="form-label mb-8 h6">LOB <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                <select width='100%' class="form-control select2 form-select py-11 @error('lob_id') is-invalid @enderror" required name="lob_id[]" data-placeholder="Choose LOB" multiple>

                                    <option value="">{{ __('Select LOB') }}</option>
                                    @foreach($lobs as $lob)
                                      <option  value="{{ $lob->id }}">{{ $lob->name }}</option>
                                    @endforeach
                                </select>

                                </select>
                                @error('lob_id') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>


                            <div class="col-sm-12">
                                <label for="author" class="form-label mb-8 h6">Author <span class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                                <input type="text"  class="form-control py-11 @error('author') is-invalid @enderror"  name="author" id="author" placeholder="Enter Author">
                                @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-12">
                                <label for="assignment" class="form-label mb-8 h6">Assignment File </label>
                                <input type="file" class="form-control py-11 @error('assignment') is-invalid @enderror" name="assignment" id="assignment">
                                @error('assignment') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                                <div id="emailHelp" class="form-text">Upload only zip, excel, word and pdf.</div>

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


</div>




@endsection