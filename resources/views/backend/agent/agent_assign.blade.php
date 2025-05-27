@extends(backendView('layouts.app'))
@section('title', 'Account Manager Assign ')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0">  Account Manager Assign</h3>
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('admin/agent-assign-index')}}">Customers</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Account Manager Assign</li>
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
               <form action="{{url('admin/agent-assign-update')}}\{{$id}}" method="POST" id="CustomerForm" enctype="multipart/form-data">
               @method('PATCH')
                  @csrf
                  <div class="row g-3 align-items-center">
                     <div class="col-md-6">
                        <label class="form-label"> Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{$customer->name}}"placeholder="Please enter customer Name" disabled>
                        <span class="text-danger kt-form__help error name"></span>
                     </div>
                    
                     <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"  value="{{$customer->email}}"  class="form-control form-control-sm" placeholder="name@example.com" disabled>
                            <span class="text-danger kt-form__help error email"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact "  value="{{$customer->contact_number}}" placeholder="Please enter contact " disabled>
                        <span class="text-danger kt-form__help error contact "></span>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Account Manager  </label>
                        <select class="form-control category" name="agent_id" id="agent_id"   >
                        <option value="">Please Select</option>
                        @foreach($agents as $agent)
                            @if($agent->id == $customer->agent_id)
                                <option value="{{$agent->id}}" selected>{{$agent->name}}</option>
                            @else
                                <option value="{{$agent->id}}">{{$agent->name}} </option>
                            @endif
                        @endforeach
                        </select>
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
<script type="text/javascript" src="{{asset('validation/CustomerFormValidation.js')}}"></script> 
@endpush
@push('modals')
@endpush