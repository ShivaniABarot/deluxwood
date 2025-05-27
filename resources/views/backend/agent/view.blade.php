@extends(backendView('layouts.app'))
@section('title', 'View  Account Manager ')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0"> View  Account Manager</h3>
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('admin/agent-list')}}">Account Manager</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View  Account Manager</li>
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
              
                  <div class="row g-3 align-items-center">
                     <div class="col-md-4">
                        <label class="form-label"> Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{$agent->name}}"placeholder="Please enter account manager Name" disabled>
                        <span class="text-danger kt-form__help error name"></span>
                     </div>
                     <div class="col-md-4">
                        <label class="form-label">Usename <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username"  value="{{$agent->user_name}}" placeholder="Please enter Username" disabled>
                        <span class="text-danger kt-form__help error username"></span>
                     </div>
                     <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"  value="{{$agent->email}}"  class="form-control form-control-sm" placeholder="name@example.com" disabled>
                            <span class="text-danger kt-form__help error email"></span>
                        </div>
                    </div>
                    
                  </div>
                  <button  id="back_button" class="btn btn-warning mt-4 text-uppercase px-5">Back</button>
                
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
     $('#back_button').click(function(){
         const url = "{{url('/admin/agent-list')}}";
            window.location.href = url;
      });
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