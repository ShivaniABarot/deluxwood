
@extends('backend.layouts.auth')
@section('title', 'Signup')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    span.select2.select2-container.select2-container--classic{
        width: 100% !important;
    }
</style>
@endpush

@section('content')
<div class="container-xxl">

		<div class="col-lg-8 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
			<div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 50rem;">
				<!-- Form -->
				<form class="row g-1 p-3 p-md-4" action=""  method="POST" id="ModificationForm">
            
					<div class="col-6">
						<div class="mb-2">
                        <label class="form-label">Do you want to add finish side?</label>
								<select class="form-select" aria-label="Default select example" required>
									<option selected>--Select--</option>
										<option value="1">Yes</option>
									<option value="2">No</option>
								</select>
						</div>
					</div>
                    <div class="col-6">
						<div class="mb-2">
                           <label class="form-label">Choose finish side?</label>
                            <select class="form-select select2" multiple name="travel" id="finish" aria-label="Default select example" onchange=showHide()>
                                <option selected>--Select--</option>
                                <option value="1">Left</option>
                                <option value="2">Right</option>
                                 <option value="3">Both</option>
                            </select> 
						</div>
					</div>
                    
					
                    <div class="col-6">
					 <div class="mb-2">
                         <label class="form-label">Enter price for selected side</label>
                                <div class="input-group" >
								  <div class="input-group-prepend" name="left-panel" id="left-panel" style="display:none" >
								 	<span class="input-group-text">Left Finish</span>
								  </div>
								  <input type="text" class="form-control" id="dataLeft" placeholder="Price for Left" style="display:none" >
							    </div>
                                <div class="input-group">
                                  <div class="input-group-prepend" name="right-panel" id="right-panel" style="display:none">
								     <span class="input-group-text">Right Finish</span>
							       </div>
                                   <input type="text" class="form-control" id="dataRight" placeholder="Price for Right" style="display:none">
                            	</div>
                                <div class="input-group">
                                   <div class="input-group-prepend" name="both-panel" id="both-panel" style="display:none">
								     <span class="input-group-text">Both Finish</span>
							       </div>
                                    <input type="text" class="form-control" id="dataBoth" placeholder="Price for Both" style="display:none">
                                </div>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                    <div class="col-6">
						<div class="mb-2">
                        <label class="form-label">Do you want to add hinge side?</label>
								<select class="form-select" aria-label="Default select example" required>
									<option selected>--Select--</option>
										<option value="1">Yes</option>
									<option value="2">No</option>
								</select>
						</div>
					</div>
                    <div class="col-6">
						<div class="mb-2">
                           <label class="form-label">Choose hinge side?</label>
                            <select class="form-select"  name="travel" id="hinge" aria-label="Default select example" onchange=showHideHinge()>
                                <option selected>--Select--</option>
                                <option value="1">Left</option>
                                <option value="2">Right</option>
                                 <option value="3">Both</option>
                            </select>
						</div>
					</div>
					
                    <div class="col-6">
					 <div class="mb-2">
                         <label class="form-label">Enter price for selected side</label>
                                <div class="input-group" >
								  <div class="input-group-prepend" name="hinge-left-panel" id="hinge-left-panel" style="display:none" >
								 	<span class="input-group-text">Left Hinge</span>
								  </div>
								  <input type="text" class="form-control" id="hinge-dataLeft" placeholder="Price for Left" style="display:none" >
							    </div>
                                <div class="input-group">
                                  <div class="input-group-prepend" name="hinge-right-panel" id="hinge-right-panel" style="display:none">
								     <span class="input-group-text">Right Hinge</span>
							       </div>
                                   <input type="text" class="form-control" id="hinge-dataRight" placeholder="Price for Right" style="display:none">
                            	</div>
                                <div class="input-group">
                                   <div class="input-group-prepend" name="hinge-both-panel" id="hinge-both-panel" style="display:none">
								     <span class="input-group-text">Both Hinge</span>
							       </div>
                                    <input type="text" class="form-control" id="hinge-dataBoth" placeholder="Price for Both" style="display:none">
                                </div>
                        </div>
                    </div>
</div>

<div class="row g-3 ">
                    <div class="col-6">
						<div class="mb-2">
                        <label class="form-label">Do you want to depth of cabinet? *</label>
											<select class="form-select" aria-label="Default select example" required>
												<option selected>--Select--</option>
												<option value="1">Yes</option>
												<option value="2">No</option>
											</select>
						</div>
					</div>
                    <div class="col-6">
						<div class="mb-2">
                        <label class="form-label">Enter Depth Option(in inch) *</label>
                                        <input type="text" name="depthoption"class="form-control form-control-sm" placeholder="12 inch">
                                        <button class="btn1"><i class="fa fa-plus"></i></button>
                                        <span class="text-danger kt-form__help error product_name"></span>
						</div>
					</div>
	</div>
    <button type="submit" class="btn btn-primary mt-4 px-5 text-uppercase">Save</button>
                </form>
				<!-- End Form -->

			</div>
		</div>
	</div> <!-- End Row -->

</div>


@endsection

@push('custom_scripts')

<script type="text/javascript">
    function showHide() {
    let travelhistory = document.getElementById('finish')
    if (travelhistory.value == 1) {
        document.getElementById('dataLeft').style.display = 'block'
        document.getElementById('dataLeft').style.display = 'block'
     } else {
        document.getElementById('left-panel').style.display = 'none'
        document.getElementById('dataLeft').style.display = 'none'
    }
    if (travelhistory.value == 2) {
        document.getElementById('right-panel').style.display = 'block'
        document.getElementById('dataRight').style.display = 'block'
     } else {
        document.getElementById('right-panel').style.display = 'none'
        document.getElementById('dataRight').style.display = 'none'
    }
    if (travelhistory.value == 3) {
        document.getElementById('both-panel').style.display = 'block'
        document.getElementById('dataBoth').style.display = 'block'
     } else {
        document.getElementById('both-panel').style.display = 'none'
        document.getElementById('dataBoth').style.display = 'none'

    }
}
    </script>


<script type="text/javascript">
    function showHideHinge() {
    let travelhistory = document.getElementById('hinge')
    if (travelhistory.value == 1) {
        document.getElementById('hinge-left-panel').style.display = 'block'
        document.getElementById('hinge-dataLeft').style.display = 'block'
     } else {
        document.getElementById('hinge-left-panel').style.display = 'none'
        document.getElementById('hinge-dataLeft').style.display = 'none'
    }
    if (travelhistory.value == 2) {
        document.getElementById('hinge-right-panel').style.display = 'block'
        document.getElementById('hinge-dataRight').style.display = 'block'
     } else {
        document.getElementById('hinge-right-panel').style.display = 'none'
        document.getElementById('hinge-dataRight').style.display = 'none'
    }
    if (travelhistory.value == 3) {
        document.getElementById('hinge-both-panel').style.display = 'block'
        document.getElementById('hinge-dataBoth').style.display = 'block'
     } else {
        document.getElementById('hinge-both-panel').style.display = 'none'
        document.getElementById('hinge-dataBoth').style.display = 'none'

    }
}
    </script>
<script>
    $(document).ready(function() {
        $("#finish").change(function() {
            if ($("#finish").val() == 1) {
                $("#left-panel").show()
            } else {
                $("#left-panel").hide()
            }
        })
    }); 
</script>    
@endpush

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>

<script src="{{ asset('asset/plugin/select2/js/select2.full.min.js')}}"></script>
	<script>
    $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2()    });
</script>


@endpush


@push('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@endpush

@push('custom_styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('asset/plugin/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugin/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<style>
.btn1 {
  border: 1px solid black;
  background-color: white;
  border-radius:100px;
  color: black;
  margin-top:10px;
  margin-left:130px;
  font-size: 8px;
  cursor: pointer;
}
</style>

@endpush