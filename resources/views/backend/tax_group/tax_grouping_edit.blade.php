@extends(backendView('layouts.app'))

@section('title', 'Customers')

@section('content')
<div class="container-xxl">
<div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Edit Tax Grouping</h3>
                 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/tax-grouping/index')}}">Tax Grouping</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Tax Grouping</li>
                        </ol>
                    </nav>
            </div>
        </div>
    </div> <!-- Row end  -->
    <div class="row clearfix g-3">
    

        <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 100rem;">
                <!-- Form -->
                <form class="row g-1 p-3 p-md-4" action="{{url('admin\tax-grouping\update')}}\{{$customer->customer_id}}" enctype="multipart/form-data"  method="POST" id="CustomerGroupingForm">
                @method('PATCH')
                @csrf
              
                    <h5  style="margin:0 0 18px 0;"><b>Basic Information </b></h5>
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Name of Company</label>
                            <input type="text" name="company_name" readonly value="{{$customer->company_name}}"class="form-control form-control-sm" placeholder="Enter Name of Company">
                            <span class="text-danger kt-form__help error company_name"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Representative Name</label>
                            <input type="text" name="representative_name" readonly value="{{$customer->representative_name}}" class="form-control form-control-sm" placeholder="Enter Representative Name">
                            <span class="text-danger kt-form__help error representative_name"></span>
                        </div>
                    </div>
                    <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Contact number</label>
                        <input type="text" name="contact_number" readonly  value="{{$customer->contact_number}}" class="form-control form-control-sm" placeholder="Enter Contact number">
                        <span class="text-danger kt-form__help error contact_number"></span>
                    </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" readonly value="{{$customer->email}}" class="form-control form-control-sm" placeholder="name@example.com">
                            <span class="text-danger kt-form__help error email"></span>
                        </div>
                    </div>
                  
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" readonly value="{{$customer->address}}" class="form-control form-control-sm" placeholder="Enter Address">
                            <span class="text-danger kt-form__help error address"></span>
                        </div>
                    </div>
                    <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">City</label>
                        <input type="text" name="city" readonly value="{{$customer->city}}" class="form-control form-control-sm" placeholder="Enter City">
                        <span class="text-danger kt-form__help error city"></span>
                    </div>
                    </div>
                   <div class="col-md-6">
                            <label class="form-label">Tax Title <span class="text-danger">*</span></label>
                            <select class="form-control category" name="tax_group" id="taxDropdown">
                            <option value="">Please Select</option>
                              @if($customer->tax_group == "With Tax")
                              <option value="With Tax" selected>With Tax</option>
                              <option value="Without Tax">Without Tax</option>
                              @elseif($customer->tax_group == "Without Tax")
                              <option value="With Tax">With Tax</option>
                              <option value="Without Tax" selected>Without Tax</option>
                              @else
                              <option value="With Tax">With Tax</option>
                              <option value="Without Tax">Without Tax</option>
                              @endif
                            </select>
                            @error('tax_group')
                                <span class="text-danger kt-form__help error tax_title">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6" id="taxRateContainer" style="{{ optional($tax_group)->tax_group == 'With Tax' ? '' : 'display: none;' }}">
    <label class="form-label">Tax Rate(%) <span class="text-danger">*</span></label>
    <input type="text" step="0.001" class="form-control" id="tax_rate" name="tax_rate" value="{{ optional($tax_group)->tax_rate }}" placeholder="Please enter group discount" readonly>
    <span class="text-danger kt-form__help error tax_rate"></span>
</div>

                    <div class="col-12  mt-4">
                        <button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Submit</button>
                    </div>
                    
                </form>
                <!-- End Form -->

            </div>
        </div>
    </div> <!-- End Row -->

</div>
@endsection

@push('styles')

@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Plugin Js-->
<!-- <script type="text/javascript" src="{{asset('public/validation/CustomerGroupingFormValidation.js')}}"></script>  -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush

@push('custom_scripts')
<script>
     $(document).ready(function() {
        // Show/hide taxRateContainer based on the selected value of tax_group
        $('#taxDropdown').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue == 'With Tax') {
                $('#taxRateContainer').show();
            } else {
                $('#taxRateContainer').hide();
                 //$('#tax_rate').val('');
            }
        });
        
        // Trigger the change event on page load to set the initial state
        $('#taxDropdown').trigger('change');
    });
</script>

@endpush

@push('modals')

@endpush