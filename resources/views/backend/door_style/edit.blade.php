@extends(backendView('layouts.app'))

@section('title', 'Customer Group Add')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0"> Edit Door Style</h3>
				 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/door-style-list')}}">Door Styles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Door Style</li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<!-- <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Customer Group Information</h6>
				</div> -->
				<div class="card-body">
					<form action="{{url('admin/door-style-update')}}\{{$door_style->doorStyle_id}}" method="POST" id="customergroupForm" enctype="multipart/form-data">
                    @method('PATCH')
						@csrf
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label class="form-label">Door Style Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="name" value="{{$door_style->name}}" placeholder="Please enter Door Style Name">
								<span class="text-danger kt-form__help error name"></span>
							</div>
							<div class="col-md-6">
							
								<label class="form-label">Assemble Options<span class="text-danger">*</span></label>
								<select class="form-control category" name="assemble_options">
									<option value=" ">Please Select</option>
									@if($door_style->assemble_options == "Assembled")
										<option value="Assembled" selected>Assembled</option>
										<option value="Unassembled">Unassembled</option>
										<option value="Both">Both</option>
									@elseif($door_style->assemble_options == "Unassembled")
										<option value="Assembled">Assembled</option>
										<option value="Unassembled" selected>Unassembled</option>
										<option value="Both">Both</option>
									@else
										<option value="Assembled">Assembled</option>
										<option value="Unassembled">Unassembled</option>
										<option value="Both" selected>Both</option>
									@endif
									
								</select>
								<span class="text-danger kt-form__help error assemble_options"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Line<span class="text-danger">*</span></label>
								<select class="form-control category" name="line">
									<option value=" ">Please Select</option>
									@if($door_style->line == "Framed")
									<option value="Framed" selected>Framed</option>
									<option value="Frameless">Frameless</option>
									@elseif($door_style->line == "Frameless")
									<option value="Framed" >Framed</option>
									<option value="Frameless" selected>Frameless</option>
									@else
									<option value="Framed" >Framed</option>
									<option value="Frameless">Frameless</option>
									@endif
								</select>
								<span class="text-danger kt-form__help error line"></span>
							</div>
							<div class="col-md-6" >
								<label class="form-label" style="margin-top:30px;"> Description <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="3" name="description" placeholder="Please enter  description" style="resize: none;">{{$door_style->description}}</textarea>
								<span class="text-danger kt-form__help error description"></span>
							</div>
						</div>
                        <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label"> Image <span class="text-danger">*</span></label>
                               <input type="File" class="form-control" id="image" name="image" onCLick="imageClicked()" value="{{$door_style->image}}">
                                @if ($errors->has('image'))
                                    <div class="text-danger">{{ $errors->first('image') }}</div>
                                @endif

                                <span class="text-danger" id="image_error"></span>
                            </div>
                        <img id="imgPreview" class="userimage" height="100" width="100" src="{{asset('public/img/door_style/'.$door_style->image)}}"/>
                    </div>
           
						<button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div><!-- Row End -->
</div>
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<script>
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