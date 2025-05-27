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
                                    <label  class="form-label">Profile Picture</label>
                                    <!-- <input type="file" name="logo" class="form-control" id="file-input" onCLick="choose_Logo(this)" > -->
                                    <span class="text-danger" id="logo"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="preview" class="preview_img"></div>
                                
								@if ($user['company_logo'] !== null && $user['company_logo'] !== '')
									<img src="{{ asset('public/img/companyLogo/' . $user['company_logo']) }}" style="height: 100px; width: 100px" class='preview-image'>
								@else
									<!-- Put the default image or any alternative content here -->
									<p>No company logo available</p>
								@endif
								
                            </div>
							<div class="row g-3 align-items-center" style="margin-top:30px">

							<div class="col-6">
								<div class="mb-2">
									<label class="form-label">Company Name</label>
									<input type="text" name="company_name"  value="{{$user->company_name}}" class="form-control form-control-sm" readonly >
									<span class="text-danger kt-form__help error company_name"></span>
								</div>
							</div>
							
                            <div class="col-6">
								<div class="mb-2">
									<label class="form-label">Name Of Representative</label>
									<input type="text" name="representative_name"  value="{{$user->representative_name}}" class="form-control form-control-sm" readonly>
									<span class="text-danger kt-form__help error representative_name"></span>
								</div>
							</div>
                            
                           
                            <div class="col-6">
								<div class="mb-2">
									<label class="form-label">Phone</label>
									<input type="text" name="contact_number"  value="{{$user->contact_number}}"class="form-control form-control-sm" readonly>
									<span class="text-danger kt-form__help error contact_number"></span>
								</div>
							</div>
                            <div class="col-6">
								<div class="mb-2">
									<label class="form-label">Email</label>
                               		<input type="text" name="email"  value="{{$user->email}}"class="form-control form-control-sm" readonly>
									<span class="text-danger kt-form__help error email"></span>
								</div>
							</div>
                            <div class="col-6">
								<div class="mb-2">
									<label class="form-label">Address</label>
                               		<input type="text" name="address"  value="{{$user->address}}"class="form-control form-control-sm" readonly>
									<span class="text-danger kt-form__help error address"></span>
								</div>
							</div>
							
						</div>
						</div>
						<!-- <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">Save Changes</button> -->
					</form>
				</div>
			</div>
	
		</div>
	</div><!-- Row end  -->

</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>

@endpush


