@extends(backendView('layouts.auth'))

@section('title', 'Signup')

@section('content')
<div class="container-xxl">

	<div class="row g-0">
		
		<div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
			<div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 50rem;">
				<!-- Form -->
				<form class="row "  id="ModificationForm" action="{{ route('modificationmaster.store') }}"   method="POST">
                @csrf
                <div class="col-6">
						<div class="mb-2">
                        <label class="form-label">Do you want to add finish side?</label>
								<select class="form-select" name="add_finish" aria-label="Default select example" required>
									<option selected>--Select--</option>
										<option value="1">Yes</option>
									<option value="2">No</option>
								</select>
                                <span class="text-danger kt-form__help error add_finish"></span>
						</div>
					</div>
                    <div class="col-6">
						<div class="mb-2">
                           <label class="form-label">Choose finish side?</label>
                            <select class="form-select" multiple name="choose_finish[]" id="finish" aria-label="Default select example" onchange=showHide()>
                                <option value="Left" >Left</option>
                                <option value="Right">Right</option>
                                <option value="Both">Both</option>
                            </select> 
                            <span class="text-danger kt-form__help error choose_finish"></span>

                    	</div>
					</div>
                    
                    <div class="col-6">
					 <div class="mb-2">
                         <label class="form-label">Enter price for selected side</label>
                                <div class="input-group" >
								  <div class="input-group-prepend" name="left-panel" id="left-panel"  style="display:none">
								 	<span class="input-group-text">Left Finish</span>
								  </div>
								  <input type="text" class="form-control" name="left" id="dataLeft" placeholder="Price for Left"  style="display:none">
                                  <span class="text-danger kt-form__help error left"></span>
                                                
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend" name="right-panel" id="right-panel"  style="display:none">
								     <span class="input-group-text">Right Finish</span>
							       </div>
                                   <input type="text" class="form-control" name="right "id="dataRight" placeholder="Price for Right"  style="display:none">
                                   <span class="text-danger kt-form__help error right"></span>
                            	
                                </div>
                                <div class="input-group">
                                   <div class="input-group-prepend" name="both-panel" id="both-panel"  style="display:none">
								     <span class="input-group-text">Both Finish</span>
							       </div>
                                    <input type="text" class="form-control" name="both" id="dataBoth" placeholder="Price for Both"  style="display:none">
                                    <span class="text-danger kt-form__help error both"></span>
                               
                                </div>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                    <div class="col-6">
						<div class="mb-2">
                        <label class="form-label">Do you want to add hinge side?</label>
								<select class="form-select" name="add_hinge" aria-label="Default select example" required>
									<option selected>--Select--</option>
										<option value="1">Yes</option>
									<option value="2">No</option>
								</select>
                                <span class="text-danger kt-form__help error add_hinge"></span>
						</div>
					</div>
                    <div class="col-6">
						<div class="mb-2">
                           <label class="form-label">Choose hinge side?</label>
                            <select class="form-select" multiple name="choose_hinge[]" id="hinge" aria-label="Default select example" onchange=showHideHinge()>
                                <option value="Left" >Left</option>
                                <option value="Right">Right</option>
                                <option value="Both">Both</option>
                            </select>
                            <span class="text-danger kt-form__help error choose_hinge"></span>

						</div>
					</div>
					<div>
                </div>
  <div class="col-6">
					 <div class="mb-2">
                         <label class="form-label">Enter price for selected side</label>
                                <div class="input-group" >
								  <div class="input-group-prepend" name="hinge-left-panel" id="hinge-left-panel" style="display:none" >
								 	<span class="input-group-text">Left Hinge</span>
								  </div>
								  <input type="text" class="form-control" name="hingeleft" id="hinge-dataLeft" placeholder="Price for Left" style="display:none" >
                                  <span class="text-danger kt-form__help error hingeleft"></span>
							   
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend" name="hinge-right-panel" id="hinge-right-panel" style="display:none">
								     <span class="input-group-text">Right Hinge</span>
							       </div>
                                   <input type="text" class="form-control" name="hingeright" id="hinge-dataRight" placeholder="Price for Right" style="display:none">
                                   <span class="text-danger kt-form__help error hingeright"></span>
                            	
                                </div>
                                <div class="input-group">
                                   <div class="input-group-prepend" name="hinge-both-panel" id="hinge-both-panel" style="display:none">
								     <span class="input-group-text">Both Hinge</span>
							       </div>
                                    <input type="text" class="form-control" name="hingeboth" id="hinge-dataBoth" placeholder="Price for Both" style="display:none">
                                    <span class="text-danger kt-form__help error hingeboth"></span>
                                
                                </div>
                        </div>
                    </div>
                  </div>
                  <div class="row g-3 ">
                    <div class="col-6">
						<div class="mb-2">
                        <label class="form-label">Do you want to depth of cabinet? *</label>
											<select class="form-select" name="depth_cabinet" aria-label="Default select example" required>
												<option selected>--Select--</option>
												<option value="1">Yes</option>
												<option value="2">No</option>
											</select>
                                    <span class="text-danger kt-form__help error depth_cabinet"></span>

						</div>
					</div>
                    <div class="col-6">
						<div class="mb-2">
                        <label class="form-label">Enter Depth Option(in inch) *</label>
                                        <input type="text" name="depth_inch1"class="form-control form-control-sm" placeholder="12 inch">
                                        <button class="btn1"><i class="fa fa-plus"></i></button>
                                        <span class="text-danger kt-form__help error depth_inch1"></span>
						</div>
					</div>
	               </div>
                    
                <!-- <select id="states1" multiple>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <!-- Add more options for other states
                </select> -->

				
                <button type="submit" class="btn btn-primary mt-4 px-5 text-uppercase">Save</button>
					
				</form>
				<!-- End Form -->

			</div>
		</div>
	</div> <!-- End Row -->

</div>


@endsection

@push('styles')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@push('custom_styles')
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

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('public/validation/ModificationFormValidation.js')}}"></script>
@endpush

@push('custom_scripts')
<script>
    $(document).ready(function() {
        $('#finish').select2();
    });
</script>

<script>
    $(document).ready(function() {
        $('#hinge').select2();
    });
</script>

<script type="text/javascript">
    function showHide() {
    let travelhistory = document.getElementById('finish')
    if (travelhistory.value == Left) {
        document.getElementById('left-panel').style.display = 'block'
        document.getElementById('dataLeft').style.display = 'block'
    } 
    else
    {
        document.getElementById('left-panel').style.display = 'none'
        document.getElementById('dataLeft').style.display = 'none'
    }
    if (travelhistory.value == Right) {
        document.getElementById('right-panel').style.display = 'block'
        document.getElementById('dataRight').style.display = 'block'
     } else {
        document.getElementById('right-panel').style.display = 'none'
        document.getElementById('dataRight').style.display = 'none'
    }
    if (travelhistory.value == Both) {
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
    if (travelhistory.value == Left) {
        document.getElementById('hinge-left-panel').style.display = 'block'
        document.getElementById('hinge-dataLeft').style.display = 'block'
     } else {
        document.getElementById('hinge-left-panel').style.display = 'none'
        document.getElementById('hinge-dataLeft').style.display = 'none'
    }
    if (travelhistory.value == Right) {
        document.getElementById('hinge-right-panel').style.display = 'block'
        document.getElementById('hinge-dataRight').style.display = 'block'
     } else {
        document.getElementById('hinge-right-panel').style.display = 'none'
        document.getElementById('hinge-dataRight').style.display = 'none'
    }
    if (travelhistory.value == Both) {
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
            if ($("#finish").val() == 1) 
            {
                $("#left-panel").show()
            } 
            else 
            {
                $("#left-panel").hide()
                $("#dataLeft").hide()
            }
            if ($("#finish").val() == 2) 
            {
                $("#right-panel").show()
            } 
            else 
            {
                $("#right-panel").hide()
                $("#dataRight").hide()
            }
            if ($("#finish").val() == 3) 
            {
                $("#both-panel").show()
            } 
            else 
            {
                $("#both-panel").hide()
                $("#dataBoth").hide()
            }
        })
    }); 
</script>  

<script>
    $(document).ready(function() {
        $("#hinge").change(function() {
            if ($("#hinge").val() == 1) 
            {
                $("#hinge-left-panel").show()
            } 
            else 
            {
                $("#hinge-left-panel").hide()
                $("#hinge-dataLeft").hide()
            }
            if ($("#hinge").val() == 2) 
            {
                $("#hinge-right-panel").show()
            } 
            else 
            {
                $("#hinge-right-panel").hide()
                $("#hinge-dataRight").hide()
            }
            if ($("#hinge").val() == 3) 
            {
                $("#hinge-both-panel").show()
            } 
            else 
            {
                $("#hinge-both-panel").hide()
                $("#hinge-dataBoth").hide()
            }
        })
    }); 
</script>  
@endpush

@push('modals')
@endpush
