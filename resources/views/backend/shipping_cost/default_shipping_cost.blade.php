@extends(backendView('layouts.app'))

@section('title', 'Default Shipping Cost')

@section('content')
<div class="container-xxl">
<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Default Shipping Cost </h3>
				 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/shipping-cost/index')}}">Shipping Cost </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Default Shipping Cost </li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
	

		<div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
			<div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 100rem;">
				<!-- Form -->
				<form class="row g-1 p-3 p-md-4" action="{{url('admin\default-shipping-cost\update')}}" enctype="multipart/form-data"  method="POST" id="CustomerGroupingForm">
                @method('PATCH')
                @csrf
              
                    <h5  style="margin:0 0 18px 0;"><b>Basic Information </b></h5>
				
                    <div class="col-6">
						<div class="mb-2">
							<label class="form-label">In-House Delivery Shipping Cost</label>
							<input type="text" name="in_house_shipping_cost"  value="{{$DefaultShippingCost->in_house_shipping_cost}}" class="form-control form-control-sm" placeholder="Enter In-House Delivery Shipping Cost">
                            <span class="text-danger kt-form__help error in_house_shipping_cost"></span>
						</div>
					</div>
                    <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Curbside Delivery Shipping Cost </label>
                        <input type="text" name="curbside_shipping_cost"   value="{{$DefaultShippingCost->curbside_shipping_cost}}" class="form-control form-control-sm" placeholder="Enter Contact number">
                        <span class="text-danger kt-form__help error curbside_shipping_cost"></span>
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