@extends('layouts.lms')
@section('content')
<div class="dashboard-body">

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">User Details Report</span></li>
            </ul>
        </div>
<!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                <span class="text-lg"><i class="ph ph-layout"></i></span>
                <button type="button" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Export CSV
                </button>
            </div>
        </div>
        <!-- Breadcrumb Right End -->
       
          
        
    </div>
   
    @include('includes.validation-error')


    <div class="card overflow-hidden">
        <div class="card-body p-0 pt-10">
            <table id="assignmentTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                       <th class="h6 text-gray-300"  >{{ __('User Id') }}</th>
                        <th class="h6 text-gray-300"  >{{ __('User Name') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Email Id') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Sub LoB') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Date Of Joining') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Designation') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Department') }}</th>
                        <th class="h6 text-gray-300" >{{ __('Grade') }}</th>
                        <th class="h6 text-gray-300"  style="width: 111px;" >{{ __('Status') }}</th>

                    </tr>
                </thead>
                
            </table>
        </div>
      
    </div>

    
</div>

   <!-- Modal Add Event -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Report Export CSV</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form method="POST" action="{{ route('reports.user.details.export') }}">
                    @csrf
                    <p>Filter by Date Of Joining</p>

                    <div class="row">   
                        <div class="col mb-20">
                            <label for="startDate" class="form-label fw-semibold text-primary-light text-sm mb-8">Start Date</label>
                            <div class=" position-relative">
                                <input class="form-control radius-8 bg-base" max="{{ date('Y-m-d') }}" required name="start_date" id="startDate" type="date">
                                <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                        <div class="col mb-20">
                            <label for="endDate" class="form-label fw-semibold text-primary-light text-sm mb-8">End Date </label>
                            <div class=" position-relative">
                                <input class="form-control radius-8 bg-base" max="{{ date('Y-m-d') }}" required name="end_date" id="endDate" type="date">
                                <span class="position-absolute end-0 top-50 translate-middle-y me-12 line-height-1"></span>
                            </div>
                        </div>
                      
                     
                        <div class="d-flex align-items-center justify-content-center gap-8 mt-24">
                            <button type="reset" class="btn filter bg-danger-600 hover-bg-danger-800 border-danger-600 hover-border-danger-800 text-md px-24 py-12 radius-8"> 
                                <i class="ph ph-arrow-clockwise"></i>
                            </button>
                            <button type="submit" class="btn bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8"> 
                                <i class="ph ph-download"></i>
                            </button>
                            <button type="button" class="btn filter bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8"> 
                                <i class="ph ph-funnel"></i>
                            </button>
                       
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@section('scripts')

<script type="text/javascript">

$(document).ready(function() {
 
    var table = $('#assignmentTable').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            searching: true,
            lengthChange: false,
            info: false,   // Bottom Left Text => Showing 1 to 10 of 12 entries
            paging: true,
            ajax: {
                        url: '{{ route('reports.user.details.datatables') }}',
                        data: function (d) {
                            d.start_date = $('#startDate').val();
                            d.end_date = $('#endDate').val();
                        }
                    },
            //    ajax: '{{ route('reports.user.details.datatables') }}',
               columns: [
                    { data: 'candidate_id', name: 'candidate_id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'lob_id', name: 'lob_id' },
                    { data: 'doj', name: 'doj' },
                    { data: 'designation',  name: 'designation'  },
                    { data: 'department',  name: 'department'  },
                    { data: 'grade',  name: 'grade'  },
                    { data: 'status', name: 'status',},

                     ],
                language : {
                    processing: '<img src="{{asset('assets/images/logo/logo.png')}}">'
                },
                drawCallback: function () {
                $('.paging_full_numbers').addClass('card-footer flex-between flex-wrap');
                },
        });	

        $('.filter').on('click', function (e) {
            e.preventDefault();
            table.ajax.reload(); // Reload data with filters
        });
        $('#filter-form').on('submit', function (e) {
            e.preventDefault();
            table.ajax.reload(); // Reload data with filters
        });
});

</script>

{{-- DATA TABLE --}}

@endsection
@endsection