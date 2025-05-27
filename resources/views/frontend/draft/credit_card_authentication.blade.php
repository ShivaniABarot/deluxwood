@extends(backendView('layouts.app'))

@section('title', 'Customer Group Add')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Payment Add</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Credit Card Authorisation</h6>
				</div>
				<div class="card-body">
					<form action="{{url('store_credit_card')}}/{{$customer_draft_Id}}" method="POST" id="paymentForm">
						@csrf
						<!-- <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">Credit Cards <span class="text-danger">*</span></label>
                                    <select class="form-control category" name="product_category_id">
                                        <option value="">Please Select</option>
                                        @foreach($credit_card as $credit_card )
                                        <option value="{{$credit_card->customer_credit_card_id}}"> {{$credit_card->credit_card_type}}  {{$credit_card->credit_card_number}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger kt-form__help error product_category_id"></span>
                                </div>
                            </div> -->
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label class="form-label">Credit Card Number</label>
								<input type="text" class="form-control" name="credit_card_number" placeholder="Please enter group title">
								<span class="text-danger kt-form__help error credit_card_number"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Credit Card Type we accept</label>
								<div class="row">
									<div class="col-md-6">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="credit_card_type" id="exampleRadios11" value="Visa" checked="">
											<label class="form-check-label" for="exampleRadios11">
												Visa
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="credit_card_type" id="exampleRadios22" value="Mastercard">
											<label class="form-check-label" for="exampleRadios22">
												Mastercard
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label">Card Member Name</label>
								<input type="text" class="form-control" name="card_member_name" placeholder="Please enter group title">
								<span class="text-danger kt-form__help error card_member_name"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Expiration Date</label>
								<input type="date" class="form-control" name="expiration_date" placeholder="Please enter group title">
								<span class="text-danger kt-form__help error expiration_date"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Billing Address</label>
								<textarea class="form-control" rows="3" name="billing_address" placeholder="Please enter group description" style="resize: none;"></textarea>
								<span class="text-danger kt-form__help error billing_address"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Phone No</label>
								<input type="text" class="form-control" name="phone" placeholder="Please enter group title">
								<span class="text-danger kt-form__help error phone"></span>
							</div>
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
@endpush

@push('custom_scripts')
<script type="text/javascript" src="{{asset('public/validation/CreditCardValidation.js')}}"></script> 
@endpush

@push('modals')
@endpush