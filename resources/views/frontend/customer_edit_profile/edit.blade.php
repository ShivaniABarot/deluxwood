@extends(backendView('layouts.app'))
@section('title', 'Customer Edit Profile')
@section('content')
<div class="container-xxl">
   <div class="row g-3 mb-3">
      <div class="col-xl-12 col-lg-12">
         <div class="card mb-3">
            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
               <h6 class="mb-0 fw-bold ">My Account</h6>
            </div>
            <div class="card-body">
               <form action="{{url('/customer_edit_profile/update')}}/{{$user->customer_id}}" method="POST" id="customergroupForm" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf
                  <div class="row g-3 align-items-center">
                     <div class="col-12">
                         <div class="col-6 mb-2">
                             <label>Company Logo</label>
                             <input type="file" name="logo" class="form-control" id="imgInp" value="{{$user->company_logo}}">
                             <span class="text-danger" id="logo"></span>
                         </div>
                         <div id="image-container">
                             @if ($user->company_logo !== null && $user->company_logo !== '')
                                 <img id="blah" height="100" width="100" src="{{asset('public/img/companyLogo/'.$user->company_logo)}}"/>
                             @else
                                 <p id="nullMsg">No company logo available</p>
                             @endif
                         </div>
                     </div>
                     <div class="row g-3 align-items-center" style="margin-top:30px">
                        <div class="col-6">
                           <div class="mb-2">
                              <label class="form-label">Company Name</label>
                              <input type="text" name="company_name"  value="{{$user->company_name}}" class="form-control form-control-sm" >
                              <span class="text-danger kt-form__help error company_name"></span>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="mb-2">
                              <label class="form-label">Name Of Representative</label>
                              <input type="text" name="representative_name"  value="{{$user->representative_name}}" class="form-control form-control-sm">
                              <span class="text-danger kt-form__help error representative_name"></span>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="mb-2">
                              <label class="form-label">Phone</label>
                              <input type="text" name="contact_number"  value="{{$user->contact_number}}"class="form-control form-control-sm">
                              <span class="text-danger kt-form__help error contact_number"></span>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="mb-2">
                              <label class="form-label">Email</label>
                              <input type="text" name="email"  value="{{$user->email}}"class="form-control form-control-sm">
                              <span class="text-danger kt-form__help error email"></span>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="mb-2">
                              <label class="form-label">Address</label>
                              <input type="text" name="address"  value="{{$user->address}}"class="form-control form-control-sm">
                              <span class="text-danger kt-form__help error address"></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">Save Changes</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Row end  -->
</div>
@endsection
@push('scripts')
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