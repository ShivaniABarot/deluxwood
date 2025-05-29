@extends(backendView('layouts.app'))
@section('title', 'Edit Coupon ')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0"> Edit Coupon</h3>
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('admin/coupon-list')}}">Coupon</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Coupon</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   
   <!-- Row end  -->
   <div class="row clearfix g-3">
      <div class="col-lg-12">
         <div class="card mb-3">
            <!-- <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
               <h6 class="m-0 fw-bold">Customer Group Information</h6>
               </div> -->
            <div class="card-body">
               <form action="{{url('admin/coupon-update')}}\{{$coupon->coupon_id}}" method="POST" id="customergroupForm" enctype="multipart/form-data">
               @method('PATCH')
                  @csrf
                  <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                           <label class="form-label"> Coupon Code <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="coupon_code" value="{{$coupon->coupon_code}}" placeholder="Please enter coupon code">
                           <span class="text-danger kt-form__help error coupon_code"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"> Coupon Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="coupon_name"  value="{{$coupon->coupon_name}}" placeholder="Please enter coupon Name">
                            <span class="text-danger kt-form__help error coupon_name"></span>
                        </div>
                        <div class="col-6">
                           <label class="form-label">Discount Type<span class="text-danger">*</span></label>
                           <select class="form-control category" name="discount_type">
                                 <option value=" ">Please Select</option>
                                 @if($coupon->discount_type == "Percentage")
                                    <option value="Percentage" selected>Percentage</option>
                                    <option value="Fixed Amount">Fixed Amount</option>
                                 @else
                                    <option value="Percentage" >Percentage</option>
                                    <option value="Fixed Amount" selected>Fixed Amount</option>   
                                 @endif
                           </select>
                           <span class="text-danger kt-form__help error discount_type"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Discount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="discount"  value="{{$coupon->discount}}" placeholder="Please enter discount">
                            <span class="text-danger kt-form__help error discount"></span>
                        </div>
                        <div class="col-md-6">
                              <div class="mb-2">
                                 <label class="form-label">Time Limit (In Hours) <span class="text-danger">*</span></label>
                                 <input type="text" name="time_limit"   value="{{$coupon->time_limit}}" class="form-control form-control-sm" placeholder="Please enter time limit">
                                 <span class="text-danger kt-form__help error time_limit"></span>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Use Limit <span class="text-danger">*</span></label>
                                <input type="text" name="use_limit"   value="{{$coupon->use_limit}}" class="form-control form-control-sm" placeholder="Please enter use limit">
                                <span class="text-danger kt-form__help error use_limit"></span>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Minimum Price <span class="text-danger">*</span></label>
                            <input type="text" name="min_price"  value="{{$coupon->min_price}}" class="form-control form-control-sm" placeholder="Please enter minimum price">
                            <span class="text-danger kt-form__help error min_price"></span>
                        </div>
                    </div> -->
                        <div class="col-md-6">
                              <div class="mb-2">
                                 <label class="form-label">Starting Date <span class="text-danger">*</span></label>
                                 <input type="date" name="starting_date"  value="{{$coupon->starting_date}}" min="{{ Carbon\Carbon::today()->format('Y-m-d') }}" class="form-control form-control-sm"  placeholder="Please enter starting Date">
                                 <span class="text-danger kt-form__help error starting_date"></span>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" name="expiry_date"  value="{{$coupon->expiry_date}}" min="{{ Carbon\Carbon::today()->format('Y-m-d') }}" class="form-control form-control-sm" placeholder="Please enter Expiry Date">
                                <span class="text-danger kt-form__help error expiry_date"></span>
                            </div>
                        </div>
                    
                  </div>
                 
                  <button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Row End -->
</div>
@endsection
@push('styles')
@endpush
@push('custom_styles')
@endpush
@push('scripts')
<script>
   function validateForm() {
       var isValid = true;
          var image = $('#image');
        
               if(image.val()==''){
                   isValid = false;
                   $('#image_error').html("Please Select Image");
              }
              return isValid;
       }
       $('form').on('submit', validateForm);
       
       function imageClicked() {
       $('#image_error').empty(); // Clear the error message
       }
   
       $(document).ready(()=>{
         $('#image').change(function(){
           const file = this.files[0];
           console.log(file);
           if (file){
             let reader = new FileReader();
             reader.onload = function(event){
               console.log(event.target.result);
               $('#imgPreview').attr('src', event.target.result);
               $("#imgPreview").css("width", "100").css("height", "100");
             }
             reader.readAsDataURL(file);
           }
         });
       });
       
</script>
@endpush
@push('custom_scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>
@endpush
@push('modals')
@endpush