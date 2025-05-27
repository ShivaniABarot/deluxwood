@extends(backendView('layouts.app'))
@section('title', 'Customers')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0">Edit Customer </h3>
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('admin/customers')}}">Customers</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <!-- Row end  -->
   <div class="row clearfix g-3">
      <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
         <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 100rem;">
            <!-- Form -->
            <form class="row g-1 p-3 p-md-4" action="{{url('admin\customer-update')}}\{{$customer->customer_id}}" enctype="multipart/form-data"  method="POST" id="CustomerForm">
               @method('PATCH')
               @csrf
               <h5  style="margin:0 0 18px 0;"><b>Basic Information </b> <span class="text-danger">*</span></h5>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Name of Company</label>
                     <input type="text" name="company_name" value="{{$customer->company_name}}"class="form-control form-control-sm" placeholder="Enter Name of Company">
                     <span class="text-danger kt-form__help error company_name"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Representative Name</label>
                     <input type="text" name="representative_name" value="{{$customer->representative_name}}" class="form-control form-control-sm" placeholder="Enter Representative Name">
                     <span class="text-danger kt-form__help error representative_name"></span>
                  </div>
               </div>
               <div class="col-4">
                  <div class="mb-2">
                     <label class="form-label">Contact number</label>
                     <input type="text" name="contact_number"  value="{{$customer->contact_number}}" class="form-control form-control-sm" placeholder="Enter Contact number">
                     <span class="text-danger kt-form__help error contact_number"></span>
                  </div>
               </div>
               <div class="col-4">
                  <div class="mb-2">
                     <label class="form-label">Email</label>
                     <input type="email" name="email" value="{{$customer->email}}" class="form-control form-control-sm" placeholder="name@example.com">
                     <span class="text-danger kt-form__help error email"></span>
                  </div>
               </div>
               <div class="col-4">
                  <div class="mb-2">
                     <label class="form-label">Fax</label>
                     <input type="text" name="fax"  value="{{$customer->fax}}" class="form-control form-control-sm" placeholder="Enter Fax">
                     <span class="text-danger kt-form__help error fax"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Address</label>
                     <input type="text" name="address" value="{{$customer->address}}" class="form-control form-control-sm" placeholder="Enter Address">
                     <span class="text-danger kt-form__help error address"></span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="mb-2">
                     <label class="form-label">City</label>
                     <input type="text" name="city" value="{{$customer->city}}" class="form-control form-control-sm" placeholder="Enter City">
                     <span class="text-danger kt-form__help error city"></span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="mb-2">
                     <label class="form-label">State</label>
                     <select class="form-control category"  name="state"   >
                        <option value="">Please Select</option>
                        @foreach($state as $index => $stateName )
                        @if($stateName == "$customer->state") 
                        <option value="{{$stateName}}" selected>{{$stateName}}</option>
                        @else
                        <option value="{{$stateName}}">{{$stateName}}</option>
                        @endif    
                        @endforeach
                     </select>
                     <!-- <input type="text" name="state" class="form-control form-control-sm" placeholder="Enter State"> -->
                     <span class="text-danger kt-form__help error state"></span>
                  </div>
               </div>
               <!-- <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Showroom</label>
                     <input type="text" name="showroom" value="{{$customer->showroom}}" class="form-control form-control-sm" placeholder="Enter Showroom">
                     <span class="text-danger kt-form__help error showroom"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Showroom SQ FT</label>
                     <input type="text" name="showroom_sq"  value="{{$customer->showroom_sq}}" class="form-control form-control-sm" placeholder="Enter Showroom SQ FT">
                     <span class="text-danger kt-form__help error showroom_sq"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Domestic lines carried</label>
                     <input type="text" name="domenstic_lines" value="{{$customer->domenstic_lines}}" class="form-control form-control-sm" placeholder="Enter Domenstic lines carried">
                     <span class="text-danger kt-form__help error domenstic_lines"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Import lines</label>
                     <input type="text" name="import_lines" value="{{$customer->import_lines}}" class="form-control form-control-sm" placeholder="Enter Import lines">
                     <span class="text-danger kt-form__help error import_lines"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Date Business Started</label>
                     <input type="date" name="date_business_started" value="{{$customer->date_business_started}}" class="form-control form-control-sm" placeholder="Enter Date Business Started">
                     <span class="text-danger kt-form__help error date_business_started"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Annual Cabinet Sales</label>
                     <input type="text" name="annual_cabinet_sales" value="{{$customer->annual_cabinet_sales}}" class="form-control form-control-sm" placeholder="Enter Annual Cabinet Sales">
                     <span class="text-danger kt-form__help error annual_cabinet_sales"></span>
                  </div>
               </div> -->
               
               <!-- <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Company Logo</label>
                     <input type="File" class="form-control" id="company_logo" name="company_logo" onCLick="compantLogoClicked()" value="{{$customer->company_logo}}">
                     @if ($errors->has('company_logo'))
                     <div class="text-danger">{{ $errors->first('company_logo') }}</div>
                     @endif
                     <span class="text-danger" id="company_logo_error"></span>
                  </div>
                  @if ($customer->company_logo !== null && $customer->company_logo !== '')
                  <img id="blah" height="100" width="100" src="{{asset('public/img/companyLogo/'.$customer->company_logo)}}"/>
                  @else
                  <p id="nullMsg">No company logo available</p>
                  @endif
               </div> -->
               <div class="col-6 mb-2">
                  <label class="form-label">Company Logo</label>
                  <input type="file" name="logo" class="form-control" id="imgInp" value="{{$customer->company_logo}}">
                  <span class="text-danger" id="logo"></span>
               </div>
               <div id="image-container">
                  @if ($customer->company_logo !== null && $customer->company_logo !== '')
                  <img id="blah" height="100" width="100" src="{{asset('public/img/companyLogo/'.$customer->company_logo)}}"/>
                  @else
                  <p id="nullMsg">No company logo available</p>
                  @endif
               </div>
               <h5  style="margin:20px 0 18px 0;"><b>Owner Information</b> <span class="text-danger">*</span></h5>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Owner Name</label>
                     <input type="text" name="owner_name" value="{{$customer->owner_name}}" class="form-control form-control-sm" placeholder="Enter Owner Name">
                     <span class="text-danger kt-form__help error owner_name"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Owner's Address</label>
                     <input type="text" name="owner_address" value="{{$customer->owner_address}}" class="form-control form-control-sm" placeholder="Enter Owner's Address">
                     <span class="text-danger kt-form__help error owner_address"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Phone</label>
                     <input type="text" name="owner_phone" value="{{$customer->owner_phone}}" class="form-control form-control-sm" placeholder="Enter Phone">
                     <span class="text-danger kt-form__help error owner_phone"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">City</label>
                     <input type="text" name="owner_city" value="{{$customer->owner_city}}" class="form-control form-control-sm" placeholder="Enter City">
                     <span class="text-danger kt-form__help error owner_city"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">State</label>
                     <select class="form-control category"  name="owner_state" >
                        <option value="">Please Select</option>
                        @foreach($state as $index => $stateName )
                        @if($stateName == "$customer->owner_state") 
                        <option value="{{$stateName}}" selected>{{$stateName}}</option>
                        @else
                        <option value="{{$stateName}}">{{$stateName}}</option>
                        @endif    
                        @endforeach
                     </select>
                     <!-- <input type="text" name="owner_state" class="form-control form-control-sm" placeholder="Enter State"> -->
                     <span class="text-danger kt-form__help error owner_state"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Zip</label>
                     <input type="text" name="owner_zip" value="{{$customer->owner_zip}}" class="form-control form-control-sm" placeholder="Enter Zip">
                     <span class="text-danger kt-form__help error owner_zip"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Email</label>
                     <input type="email" name="owner_email" value="{{$customer->owner_email}}" class="form-control form-control-sm" placeholder="Enter Email">
                     <span class="text-danger kt-form__help error owner_email"></span>
                  </div>
               </div>
               <h5  style="margin:20px 0 18px 0;"><b>Reference </b></h5>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Name of company</label>
                     <input type="text" name="reference_com_name" value="{{$customer->reference_com_name}}" class="form-control form-control-sm" placeholder="Enter Name of company">
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Address</label>
                     <input type="text" name="reference_address" value="{{$customer->reference_address}}" class="form-control form-control-sm" placeholder="Enter Address">
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Contact Number</label>
                     <input type="text" name="reference_contact_number" value="{{$customer->reference_contact_number}}" class="form-control form-control-sm" placeholder="Enter Contact Number">
                     <span class="text-danger kt-form__help error reference_contact_number"></span>
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">City</label>
                     <input type="text" name="reference_city" value="{{$customer->reference_city}}" class="form-control form-control-sm" placeholder="Enter City">
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">State</label>
                     <select class="form-control category"  name="reference_state" >
                        <option value="">Please Select</option>
                        @foreach($state as $index => $stateName )
                        @if($stateName == "$customer->reference_state") 
                        <option value="{{$stateName}}" selected>{{$stateName}}</option>
                        @else
                        <option value="{{$stateName}}">{{$stateName}}</option>
                        @endif    
                        @endforeach
                     </select>
                     <!-- <input type="text" name="reference_state"class="form-control form-control-sm" placeholder="Enter State"> -->
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label"> Zip </label>
                     <input type="text" name="reference_zip" value="{{$customer->reference_zip}}" class="form-control form-control-sm" placeholder="Enter Zip">
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Email</label>
                     <input type="email" name="reference_email" value="{{$customer->reference_email}}" class="form-control form-control-sm" placeholder="name@example.com">
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label"> Type of Account </label>
                     <input type="text" name="account_type" value="{{$customer->account_type}}"  class="form-control form-control-sm" placeholder="Enter Account Type">
                  </div>
               </div>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label"> Status </label>
                     <select class="form-control category" id="status" name="status" >
                        <option value="">Please Select</option>
                        @if($customer->status == "Active")
                        <option value="Active" selected>Active</option>
                        <option value="Inactive">Inactive</option>
                        @else
                        <option value="Active">Active</option>
                        <option value="Inactive" selected>Inactive</option>
                        @endif
                     </select>
                  </div>
               </div>
               <h5 style="margin:20px 0 18px 0;"><b>Tax Exempt</b> <span class="text-danger">*</span></h5>
               <div class="col-6">
                  <div class="mb-2">
                     <label class="form-label">Are you Tax Exempt</label>
                     <select class="form-control category" id="tex_exempt"  name="tex_exempt" >
                        <option value="">Please Select</option>
                        @if($customer->tex_exempt == "Yes")
                        <option value="Yes" selected>Yes</option>
                        <option value="No">No</option>
                        @else
                        <option value="Yes" >Yes</option>
                        <option value="No" selected>No</option>
                        @endif
                     </select>
                     <span class="text-danger kt-form__help error tex_exempt"></span>
                  </div>
               </div>
               <input type="text" value="{{$customer->tex_exempt}}" id="old_tex_exempt" hidden>
               @if($customer->tex_exempt == "Yes")
               <div class="col-6" id="texId_div">
                  <div class="mb-2">
                     <label class="form-label">Tax Id</label>
                     <input type="text" name="tex_id" value="{{$customer->tex_id}}" class="form-control form-control-sm" placeholder="Enter Tax Id">
                     <span class="text-danger kt-form__help error tex_id"></span>
                  </div>
               </div>
               @else
               <div class="col-6" id="texId_div">
                  <div class="mb-2">
                     <label class="form-label">Tax Id</label>
                     <input type="text" name="tex_id"  class="form-control form-control-sm" placeholder="Enter Tax Id">
                     <span class="text-danger kt-form__help error tex_id"></span>
                  </div>
               </div>
              
               @endif
               <div class="col-6" id="texId_div">
                  <div class="mb-2">
                     <label class="form-label">Note</label>
                     <input type="text" name="company_note"  value="{{$customer->company_note}}" class="form-control form-control-sm" placeholder="Enter company note">
                     <span class="text-danger kt-form__help error company_note"></span>
                  </div>
               </div>
               <input type="text" id="customer_id" value="{{$customer->customer_id}}" hidden>
               <div class="col-6" id="texForm_div">
                  <div class="mb-2">
                     <label class="form-label">Tax Exempt Form</label><br>
                     <!-- <input type="file" class="custom-file-input" id="tex_form" name="tex_exempt_form" onCLick="texFormClicked()"><br> -->
                     <input type="File" class="form-control" id="tex_form" name="tex_exempt_form" onCLick="texFormClicked()"  value="{{$customer->tex_exempt_form}}">
                     <!-- <span class="custom-file-label">Choose file</span> -->
                     <span class="text-danger" id="tex_form_error"></span>
                  </div>
               </div>
               <div class="col-12 text-center mt-4">
                  <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" alt="SIGNUP">Update</button>
               </div>
            </form>
            <!-- End Form -->
         </div>
      </div>
   </div>
   <!-- End Row -->
</div>
@endsection
@push('styles')
@endpush
@push('custom_styles')
@endpush
@push('scripts')
<!-- Plugin Js-->
<script type="text/javascript" src="{{asset('public/validation/CustomerFormValidation.js')}}"></script> 
@endpush
@push('custom_scripts')
<script>
   $(document).ready(()=>{
   if( $('#tex_exempt').val() == "Yes"){
         $('#texId_div').show();
         $('#texForm_div').show();
   }else{
     $('#texId_div').hide();
     $('#texForm_div').hide();
   }
   $('#tex_exempt').change(function(){
     let tex_exempt = $(this).val();
     if(tex_exempt == "Yes"){
         $('#texId_div').show();
         $('#texForm_div').show();
     }else{
         $('#texId_div').hide();
         $('#texForm_div').hide();
     }
   })
   
   });
   
   function validateForm() {
   var isValid = true;
   var old_tex_exempt = $('#old_tex_exempt');
    var tex_form = $('#tex_form');
    var tex_exempt = $('#tex_exempt');
     if(old_tex_exempt.val() ===  "No"){
         if(tex_exempt.val() === "Yes"){
             if(tex_form.val()==''){
                 isValid = false;
                 $('#tex_form_error').html("Please Select Tax exempt Form");
                 console.log("hjsf");
         }
        return isValid;
         }
     }
   
   }
   $('form').on('submit', validateForm);
   
   function texFormClicked() {
     $('#tex_form_error').empty(); // Clear the error message
   }

</script>
<script>
   $(document).ready(()=>{
      
      $('#status').change(function(){
          let status = $(this).val();
          if(status == "Active"){
           Active();
          }else{
           Inactive();
          }
      })
   })
   
      $(function(){
      
        // showing modal with effect
        $('.modal-effect').on('click', function(e){
          e.preventDefault();
      
          var effect = $(this).attr('data-effect');
          $('#exampleModalLive').addClass(effect);
          $('#exampleModalLive').modal('show');
        });
      
        // hide modal with effect
        $('#exampleModalLive').on('hidden.bs.modal', function (e) {
          $(this).removeClass (function (index, className) {
              return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
          });
        });
      });
      
         function Active() {
           id=$('#customer_id').val();
           $("#exampleModalLive").modal('show');
              
           $('#yes').on('click', function(event){
               document.getElementById("yes").disabled = true;
               $("#conformation-modal").modal('hide');
               $.ajax({
                   url: "{{ url('admin/customer/active') }}"+'/'+id,
                   type: 'GET',
                   dataType: 'html',
                   success:function(response) {
                      var obj = JSON.parse(response);
                       if (obj.status == 'success') {
                              location.reload();
                       }else{
                           alert(obj.msg);
                            location.reload();
                       }
                      
                   }
      
               });
           });
      }
      
      $(function(){
      
        // showing modal with effect
        $('.modal-effect').on('click', function(e){
          e.preventDefault();
      
          var effect = $(this).attr('data-effect');
          $('#exampleModalLivereject').addClass(effect);
          $('#exampleModalLivereject').modal('show');
        });
      
        // hide modal with effect
        $('#exampleModalLivereject').on('hidden.bs.modal', function (e) {
          $(this).removeClass (function (index, className) {
              return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
          });
        });
      });
      
      function Inactive() {
             id=$('#customer_id').val();
           $("#exampleModalLivereject").modal('show');
              
           $('#yesre').on('click', function(event){
               document.getElementById("yesre").disabled = true;
               $("#conformation-modal").modal('hide');
               $.ajax({
                   url: "{{ url('admin/customer/inactive') }}"+'/'+id,
                   type: 'GET',
                   dataType: 'html',
                   success:function(response) {
                      var obj = JSON.parse(response);
                       if (obj.status == 'success') {
                              location.reload();
                       }else{
                           alert(obj.msg);
                            location.reload();
                       }
                      
                   }
      
               });
           });
      }
</script>
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image-container').empty();
                $('<img>').attr('id', 'blah').attr('src', e.target.result).css('width', '100').css('height', '100').appendTo('#image-container');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>
@endpush
@push('modals')
<!-- Approve -->
<div class="modal fade" id="exampleModalLive" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Active</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Are you sure you want to Active this customer ?</p>
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-primary" id="yes">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
         </div>
      </div>
   </div>
</div>
<!-- Rejected -->
<div class="modal fade" id="exampleModalLivereject" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Inactive</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Are you sure you want to Inactive this customer ?</p>
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-primary" id="yesre">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
         </div>
      </div>
   </div>
</div>
@endpush