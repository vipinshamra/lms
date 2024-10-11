@extends('layouts.lms')
@section('content')


<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">User</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->
                 
    

    <div class="tab-content" id="pills-tabContent">
        <!-- My Details Tab start -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Edit User</h4>
                </div>
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

                    <form id="form-create" action="{{ route('user.update', $user->id)}}" method="post"  class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row gy-4">
                            <div class="col-sm-6 col-xs-6">
                                <label for="candidate_id" class="form-label mb-8 h6">Candidate ID</label>
                                <input type="text" value="{{ $user->candidate_id }}" class="form-control py-11 @error('candidate_id') is-invalid @enderror" name="candidate_id" id="candidate_id" placeholder="Enter Candidate ID">
                                @error('candidate_id') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="fname" class="form-label mb-8 h6">Name</label>
                                <input type="text" value="{{ $user->name }}" class="form-control py-11 @error('name') is-invalid @enderror"   name="name" id="fname" placeholder="Enter Name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="email" class="form-label mb-8 h6">Email</label>
                                <input type="text" value="{{ $user->email }}" class="form-control py-11 @error('email') is-invalid @enderror"   name="email" id="email" placeholder="Enter Email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                            <div class="col-sm-6 col-xs-6">
                                <label for="phone" class="form-label mb-8 h6">Phone</label>
                                <input type="number" value="{{ $user->phone }}" class="form-control py-11 @error('phone') is-invalid @enderror"   name="phone" id="phone" placeholder="Enter Phone">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
         
                            <div class="col-sm-6 col-xs-6">
                                <label for="lob" class="form-label mb-8 h6">Course Applicability</label>
                                <select class="form-control py-11 @error('lob_id') is-invalid @enderror" required name="lob_id">
                                    
                                    <option value="">{{ __('Select LOB') }}</option>
                                    @foreach($lobs as $lob)
                                      <option  value="{{ $lob->id }}" {{ $user->lob_id==$lob->id?'selected':'' }} >{{ $lob->name }}</option>
                                    @endforeach
                                </select>

                                </select>
                                @error('lob_id') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>

                           

                            <div class="col-sm-6 col-xs-6">
                                <label for="designation" class="form-label mb-8 h6">Designation</label>
                                <input type="text" class="form-control py-11 @error('designation') is-invalid @enderror"  value="{{ $user->designation }}"  name="designation" id="designation" placeholder="Enter Designation">
                                @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="grade" class="form-label mb-8 h6">Grade</label>
                                <input type="text" class="form-control py-11 @error('grade') is-invalid @enderror"  value="{{ $user->grade }}" name="grade" id="grade" placeholder="Enter Grade">
                                @error('grade') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="department" class="form-label mb-8 h6">Department</label>
                                <input type="text" class="form-control py-11 @error('department') is-invalid @enderror"  value="{{ $user->department }}"  name="department" id="department" placeholder="Enter Department">
                                @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="employment_type" class="form-label mb-8 h6">Employment Type</label>
                                <input type="text" class="form-control py-11 @error('employment_type') is-invalid @enderror"  value="{{ $user->employment_type }}"  name="employment_type" id="employment_type" placeholder="Enter Employment Type">
                                @error('employment_type') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="expectance_date" class="form-label mb-8 h6">Offer Acceptance Date</label>
                                <input type="date" class="form-control py-11 @error('expectance_date') is-invalid @enderror" value="{{ $user->expectance_date }}"  name="expectance_date" id="expectance_date" placeholder="">
                                @error('expectance_date') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="actual_date" class="form-label mb-8 h6">Date of Joining</label>
                                <input type="date" class="form-control py-11 @error('actual_date') is-invalid @enderror" value="{{ $user->actual_date }}" name="actual_date" id="actual_date" placeholder="">
                                @error('actual_date') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            <div class="col-sm-6 col-xs-6">
                                <label for="recruiter" class="form-label mb-8 h6">Recruiter</label>
                                <input type="text" class="form-control py-11 @error('recruiter') is-invalid @enderror" value="{{ $user->recruiter }}"  name="recruiter" id="recruiter" placeholder="Enter Recruiter">
                                @error('recruiter') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                            
                 
                            {{-- <div class="col-sm-6 col-xs-6">
                                <label for="offer_revoke" class="form-label mb-8 h6">Offer revoke</label>
                                <input type="text" class="form-control py-11 @error('offer_revoke') is-invalid @enderror"  value="{{ $user->offer_revoke }}"  name="offer_revoke" id="offer_revoke" placeholder="Enter Offer Revoke">
                                @error('offer_revoke') <div class="invalid-feedback">{{ $message }}</div> @enderror  
                            </div>
                             --}}

                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
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