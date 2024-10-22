@extends('layouts.lms')
@section('content')


<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">SME</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
                 
    

    <div class="tab-content" id="pills-tabContent">
        <!-- My Details Tab start -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Create New SME</h4>
                </div>
                <div class="card-body">
                    
                    @include('includes.validation-error')


                    <form id="form-create" action="{{ route('sme.store')}}" method="post"  class="needs-validation" novalidate>
                        @csrf
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xs-6">
                                <label for="fname" class="form-label mb-8 h6">Name</label>
                                <input type="text" class="form-control py-11 @error('name') is-invalid @enderror"  value="{{ old('name', '') }}"  name="name" id="fname" placeholder="Enter Name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="email" class="form-label mb-8 h6">Email</label>
                                <input type="text"  class="form-control py-11 @error('email') is-invalid @enderror"  value="{{ old('email', '') }}"  name="email" id="email" placeholder="Enter Email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="phone" class="form-label mb-8 h6">Phone</label>
                                <input type="number"  class="form-control py-11 @error('phone') is-invalid @enderror" value="{{ old('phone', '') }}"  name="phone" id="phone" placeholder="Enter Phone">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
         
                            <div class="col-sm-6 col-xs-6">
                                <label for="lob" class="form-label mb-8 h6">LOB</label>
                                <select class="form-control py-11 @error('lob_id') is-invalid @enderror" required name="lob_id">
                                    
                                    <option value="">{{ __('Select LOB') }}</option>
                                    @foreach($lobs as $lob)
                                      <option  value="{{ $lob->id }}">{{ $lob->name }}</option>
                                    @endforeach
                                </select>

                                </select>
                                @error('lob_id') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                           
                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="submit" class="btn btn-main rounded-pill py-9">Save  Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- My Details Tab End -->
        
    </div>
</div>


   
@endsection