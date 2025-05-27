@extends(backendView('layouts.app'))

@section('title', 'Customers')

@section('content')
<div class="container-xxl">
<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Edit Pay Later Group </h3>
				 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/pay-later-group/index')}}">Pay Later Group </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Pay Later Group </li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
	

		<div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
			<div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 100rem;">
				<!-- Form -->
				<form class="row g-1 p-3 p-md-4" action="{{url('admin\pay-later-group\update')}}\{{$customer->customer_id}}" enctype="multipart/form-data"  method="POST" id="CustomerGroupingForm">
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
                   <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Pay Later </label>
                            <select class="form-control category form-select" name="pay_later">
                                <option value="">Please Select</option>
                                @if($customer->pay_later == "Yes")
                                <option value="Yes" selected >Yes</option>
                                <option value="No"> No</option>
                                @else
                                <option value="Yes" >Yes</option>
                                <option value="No" selected> No</option>
                                @endif
                            </select>
                          
                            <span class="text-danger kt-form__help error pay_later"></span>
                        </div>
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
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupingFormValidation.js')}}"></script> 
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
                    $('#tex_form_error').html("Please Select Tex xempt Form");
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
  

// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();

//         reader.onload = function (e) {
//             $('#blah').attr('src', e.target.result);
//             $("#blah").css("width", "100").css("height", "100");
//         }

//         reader.readAsDataURL(input.files[0]);
//     }
// }
// $("#tex_form").change(function(){
//     readURL(this);
// });

$(document).ready(()=>{
      $('#company_logo').change(function(){
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

@push('modals')

@endpush