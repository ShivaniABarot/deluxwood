@extends(backendView('layouts.app'))
@section('title', 'Edit Account Manager ')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0"> Edit Account Manager</h3>
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('admin/agent-list')}}">Account Manager</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Account Manager</li>
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
               <form action="{{url('admin/agent-update')}}\{{$agent->agent_id}}" method="POST" id="customergroupForm" enctype="multipart/form-data">
               @method('PATCH')
                  @csrf
                  <div class="row g-3 align-items-center">
                     <div class="col-md-4">
                        <label class="form-label"> Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{$agent->name}}"placeholder="Please enter Agent Name">
                        <span class="text-danger kt-form__help error name"></span>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Usename <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username"  value="{{$agent->user_name}}" placeholder="Please enter Username">
                        <span class="text-danger kt-form__help error username"></span>
                     </div>
                     <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"  value="{{$agent->email}}"  class="form-control form-control-sm" placeholder="name@example.com">
                            <span class="text-danger kt-form__help error email"></span>
                        </div>
                    </div>
                     <div class="col-6" style="margin-top:30px;">
						<div class="mb-2">
							<label class="form-label">Password <span class="text-danger">*</span></label>
							<input type="password" name="password" class="form-control form-control-sm" placeholder="8+ characters required">
                            <span class="text-danger kt-form__help error password"></span>
						</div>
					</div>
					<div class="col-6"  style="margin-top:30px;">
						<div class="mb-2">
							<label class="form-label">Confirm password <span class="text-danger">*</span></label>
							<input type="password" name="confirm_password" class="form-control form-control-sm" placeholder="8+ characters required">
                            <span class="text-danger kt-form__help error confirm_password"></span>
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