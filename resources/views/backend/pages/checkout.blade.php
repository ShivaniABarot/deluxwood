@extends(backendView('layouts.app'))

@section('title', 'Checkout')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Checkout Details</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3 mb-3">
		<div class="col-lg-12 col-xl-8">
			<div class="card">
				<div class="card-body">
					<div class="checkout-steps">
						<ul id="accordionExample">
							<li>
								<section>
									<h6 class="title collapsed fw-bold" id="headingOne" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Your Personal Details </h6>
									<div class="checkout-steps-form-content collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
										<form class="mt-3">
											<div class="row g-3 align-items-center">
												<div class="col-md-6">
													<label for="firstname1" class="form-label">First Name</label>
													<input type="text" class="form-control" id="firstname1" required>
												</div>
												<div class="col-md-6">
													<label for="lastname1" class="form-label">Last Name</label>
													<input type="text" class="form-control" id="lastname1" required>
												</div>
												<div class="col-md-6">
													<label for="phonenumber1" class="form-label">Phone Number</label>
													<input type="text" class="form-control" id="phonenumber1" required>
												</div>
												<div class="col-md-6">
													<label for="emailaddress1" class="form-label">Email Address</label>
													<input type="email" class="form-control" id="emailaddress1" required>
												</div>
												<div class="col-md-12">
													<label class="form-label">Shipping Address</label>
													<input type="email" class="form-control" required>
												</div>
												<div class="col-md-6">
													<label for="cityblock1" class="form-label">City</label>
													<input type="text" class="form-control" id="cityblock1" required>
												</div>
												<div class="col-md-6">
													<label for="postcode1" class="form-label">Post Code</label>
													<input type="text" class="form-control" id="postcode1" required>
												</div>
												<div class="col-md-6">
													<label class="form-label">Country</label>
													<select class="form-select" aria-label="Default select example">
														<option selected>Country Option</option>
														<option value="1">India</option>
														<option value="2">Australia</option>
														<option value="3">Italy</option>
													</select>
												</div>
												<div class="col-md-6">
													<label class="form-label">State</label>
													<select class="form-select" aria-label="Default select example">
														<option selected>State Option</option>
														<option value="1">Gujrat</option>
														<option value="2">Kerela</option>
														<option value="3">Rajesthan</option>
													</select>
												</div>
												<div class="col-md-12">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" checked>
														<label class="form-check-label" for="flexCheckChecked1">
															My delivery and Shipping addresses are the same.
														</label>
													</div>
												</div>
											</div>

											<button type="submit" class="btn btn-primary mt-4 px-5 text-uppercase">Save</button>
										</form>
									</div>
								</section>
							</li>
							<li>
								<section>
									<h6 class="title collapsed fw-bold" id="headingTwo" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Shipping Address</h6>
									<div class="checkout-steps-form-content collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
										<form class="mt-3">
											<div class="row g-3 align-items-center">
												<div class="col-md-6">
													<label for="firstname" class="form-label">First Name</label>
													<input type="text" class="form-control" id="firstname" required>
												</div>
												<div class="col-md-6">
													<label for="lastname" class="form-label">Last Name</label>
													<input type="text" class="form-control" id="lastname" required>
												</div>
												<div class="col-md-6">
													<label for="phonenumber" class="form-label">Phone Number</label>
													<input type="text" class="form-control" id="phonenumber" required>
												</div>
												<div class="col-md-6">
													<label for="emailaddress" class="form-label">Email Address</label>
													<input type="email" class="form-control" id="emailaddress" required>
												</div>
												<div class="col-md-12">
													<label class="form-label">Shipping Address</label>
													<input type="email" class="form-control" required>
												</div>
												<div class="col-md-6">
													<label for="cityblock" class="form-label">City</label>
													<input type="text" class="form-control" id="cityblock" required>
												</div>
												<div class="col-md-6">
													<label for="postcode" class="form-label">Post Code</label>
													<input type="text" class="form-control" id="postcode" required>
												</div>
												<div class="col-md-6">
													<label class="form-label">Country</label>
													<select class="form-select" aria-label="Default select example">
														<option selected>Country Option</option>
														<option value="1">India</option>
														<option value="2">Australia</option>
														<option value="3">Italy</option>
													</select>
												</div>
												<div class="col-md-6">
													<label class="form-label">State</label>
													<select class="form-select" aria-label="Default select example">
														<option selected>State Option</option>
														<option value="1">Gujrat</option>
														<option value="2">Kerela</option>
														<option value="3">Rajesthan</option>
													</select>
												</div>
											</div>

											<div class="col-md-12">
												<div class="checkout-payment-option mt-4">
													<h6 class="form-label mb-0">Select Delivery Option</h6>
													<div class="payment-option-wrapper">
														<div class="single-payment-option">
															<input type="radio" name="shipping" checked="" id="shipping-1">
															<label for="shipping-1">
																<img src="{!! backendAssets('dist/assets/images/product/shipping-4.png') !!}" alt="Sipping">
																<span class="s-info">Standerd Shipping</span>
																<span class="price">$12.00</span>
															</label>
														</div>
														<div class="single-payment-option">
															<input type="radio" name="shipping" id="shipping-2">
															<label for="shipping-2">
																<img src="{!! backendAssets('dist/assets/images/product/shipping-3.png') !!}" alt="Sipping">
																<span class="s-info">Standerd Shipping</span>
																<span class="price">$10.00</span>
															</label>
														</div>
														<div class="single-payment-option">
															<input type="radio" name="shipping" id="shipping-3">
															<label for="shipping-3">
																<img src="{!! backendAssets('dist/assets/images/product/shipping-2.png') !!}" alt="Sipping">
																<span class="s-info">Standerd Shipping</span>
																<span class="price">$11.00</span>
															</label>
														</div>
														<div class="single-payment-option">
															<input type="radio" name="shipping" id="shipping-4">
															<label for="shipping-4">
																<img src="{!! backendAssets('dist/assets/images/product/shipping-1.png') !!}" alt="Sipping">
																<span class="s-info">Standerd Shipping</span>
																<span class="price">$18.00</span>
															</label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="steps-form-btn">
													<a href="#" class="btn btn-primary px-5 text-uppercase">Save</a>
												</div>
											</div>
										</form>
									</div>
								</section>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-xl-4">
			<div class="card  mb-3">
				<div class="card-body">
					<div class="checkout-sidebar">
						<div class="checkout-sidebar-price-table mt-30">
							<h5 class="title fw-bold">Pricing</h5>
							<div class="sub-total-price">
								<div class="total-price">
									<p class="value">Subotal Price:</p>
									<p class="price">$1096.00</p>
								</div>
								<div class="total-price shipping">
									<p class="value">Shipping Cost:</p>
									<p class="price">$12.00</p>
								</div>
								<div class="total-price discount">
									<p class="value">Discount Price:</p>
									<p class="price">$10.00</p>
								</div>
								<div class="total-price">
									<p class="value">Tax(18%):</p>
									<p class="price">$198.00</p>
								</div>
							</div>
							<div class="total-payable">
								<div class="payable-price">
									<p class="value fw-bold">Total Payable:</p>
									<p class="price fw-bold">$1296.00</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0 align-items-center">
					<div class="form-check d-flex align-items-center">
						<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
						<label class="form-check-label fw-bold d-flex align-items-center" for="flexRadioDefault1">
							<i class="icofont-mastercard-alt fs-3 mx-2"></i> Debit/Credit Card
						</label>
					</div>
				</div>
				<div class="card-body">
					<form>
						<div class="row g-3 align-items-center">
							<div class="col-md-12">
								<label class="form-label">Enter Card Number</label>
								<input type="text" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label class="form-label">Valid Date</label>
								<input type="date" class="form-control w-100" required>
							</div>
							<div class="col-md-6">
								<label class="form-label">CVV</label>
								<input type="text" class="form-control" required>
							</div>
						</div>
					</form>
				</div>
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0 align-items-center">
					<div class="form-check d-flex align-items-center">
						<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
						<label class="form-check-label fw-bold d-flex align-items-center" for="flexRadioDefault2">
							<i class="icofont-world fs-3 mx-2"></i> Net Banking
						</label>
					</div>
				</div>
				<div class="card-body">
					<form>
						<div class="row g-3 align-items-center">
							<div class="col-md-12">
								<label class="form-label">Enter Your Name</label>
								<input type="text" class="form-control" required>
							</div>
							<div class="col-md-12">
								<label class="form-label">Account Number</label>
								<input type="text" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label class="form-label">Bank Name</label>
								<input type="text" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label for="admittime1" class="form-label">IFC Code</label>
								<input type="text" class="form-control" id="admittime1" required>
							</div>
						</div>
						<a href="{!! backendRoutePut('invoices') !!}" class="btn btn-primary mt-4 text-uppercase">Pay Now</a>
					</form>
				</div>
			</div>
		</div>
	</div><!-- Row end  -->
</div>
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush