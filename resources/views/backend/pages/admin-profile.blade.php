@extends(backendView('layouts.app'))

@section('title', 'Admin Profile')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Admin Profile</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row g-3">
		<div class="col-xl-4 col-lg-5 col-md-12">
			<div class="card profile-card flex-column mb-3">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">Profile</h6>
				</div>
				<div class="card-body d-flex profile-fulldeatil flex-column">
					<div class="profile-block text-center w220 mx-auto">
						<a href="#">
							<img src="{!! backendAssets('dist/assets/images/lg/avatar4.svg') !!}" alt="" class="avatar xl rounded img-thumbnail shadow-sm">
						</a>
						<button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#editprofile"><i class="icofont-edit"></i></button>
						<div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
							<span class="text-muted small">Admin ID : PXL-0001</span>
						</div>
					</div>
					<div class="profile-info w-100">
						<h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian Allan</h6>
						<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
						<p class="mt-2">Duis felis ligula, pharetra at nisl sit amet, ullamcorper fringilla mi. Cras luctus metus non enim porttitor sagittis. Sed tristique scelerisque arcu id dignissim.</p>
						<div class="row g-2 pt-2">
							<div class="col-xl-12">
								<div class="d-flex align-items-center">
									<i class="icofont-ui-touch-phone"></i>
									<span class="ms-2">202-555-0174 </span>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="d-flex align-items-center">
									<i class="icofont-email"></i>
									<span class="ms-2">adrianallan@gmail.com</span>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="d-flex align-items-center">
									<i class="icofont-birthday-cake"></i>
									<span class="ms-2">19/03/1980</span>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="d-flex align-items-center">
									<i class="icofont-address-book"></i>
									<span class="ms-2">2734 West Fork Street,EASTON 02334.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">Payment Method</h6>
				</div>
				<div class="card-body">
					<div class="payment-info">
						<h5 class="payment-name text-muted"><i class="icofont-visa-alt fs-3"></i> Visa *******7548</h5>
						<span>Next billing charged $48</span>
						<br>
						<em class="text-muted">Autopay on July 20, 2021</em>
						<a href="javascript:void(0);" class="edit-payment-info text-secondary">Edit Payment Info</a>
					</div>
					<p class="mt-3"><a href="javascript:void(0);" class="btn btn-primary"> Add Payment Info</a></p>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<h5>Notification preferences</h5>
					<span class="text-muted">Control all our newsletter and email related notifications to your email</span>
					<div class="mt-4">
						<div class="form-check form-switch mt-2">
							<input class="form-check-input" type="checkbox" id="np-Newsletter">
							<label class="form-check-label" for="np-Newsletter">Activity Notifications</label>
						</div>
						<div class="form-check form-switch mt-2">
							<input class="form-check-input" type="checkbox" id="np-Notifications">
							<label class="form-check-label" for="np-Notifications">Comment Notifications</label>
						</div>
						<div class="form-check form-switch mt-2">
							<input class="form-check-input" type="checkbox" id="np-Preferences" checked="">
							<label class="form-check-label" for="np-Preferences">Email Preferences</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-8 col-lg-7 col-md-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">Profile Settings</h6>
				</div>
				<div class="card-body">
					<form class="row g-4">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">User Name</label>
								<input class="form-control" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Password</label>
								<input class="form-control" type="Password">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label class="form-label">Company Name <span class="text-danger">*</span></label>
								<input class="form-control" type="text" value="">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label class="form-label">Contact Person</label>
								<input class="form-control" type="text">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label class="form-label">Mobile Number <span class="text-danger">*</span></label>
								<input class="form-control" type="text">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label">Address</label>
								<textarea class="form-control" aria-label="With textarea"></textarea>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<label class="form-label">Email <span class="text-danger">*</span></label>
							<div class="input-group">
								<span class="input-group-text">@</span>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<label class="form-label">Website Url</label>
							<div class="input-group">
								<span class="input-group-text">http://</span>
								<input type="text" class="form-control" value="">
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-3">
							<div class="form-group">
								<label class="form-label">Country</label>
								<select class="form-control">
									<option value="">-- Select Country --</option>
									<option value="AF">Afghanistan</option>
									<option value="AX">Åland Islands</option>
									<option value="AL">Albania</option>
									<option value="DZ">Algeria</option>
									<option value="AS">American Samoa</option>
									<option value="AD">Andorra</option>
									<option value="AO">Angola</option>
									<option value="AI">Anguilla</option>
									<option value="AQ">Antarctica</option>
									<option value="AG">Antigua and Barbuda</option>
									<option value="AR">Argentina</option>
									<option value="AM">Armenia</option>
									<option value="AW">Aruba</option>
									<option value="AU">Australia</option>
									<option value="AT">Austria</option>
									<option value="AZ">Azerbaijan</option>
									<option value="BS">Bahamas</option>
									<option value="BH">Bahrain</option>
									<option value="BD">Bangladesh</option>
									<option value="BB">Barbados</option>
									<option value="BY">Belarus</option>
									<option value="BE">Belgium</option>
									<option value="BZ">Belize</option>
									<option value="BJ">Benin</option>
									<option value="BM">Bermuda</option>
									<option value="BT">Bhutan</option>
									<option value="BO">Bolivia, Plurinational State of</option>
									<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
									<option value="BA">Bosnia and Herzegovina</option>
									<option value="BW">Botswana</option>
									<option value="BV">Bouvet Island</option>
									<option value="BR">Brazil</option>
									<option value="IO">British Indian Ocean Territory</option>
									<option value="BN">Brunei Darussalam</option>
									<option value="BG">Bulgaria</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi</option>
									<option value="KH">Cambodia</option>
									<option value="CM">Cameroon</option>
									<option value="CA">Canada</option>
									<option value="CV">Cape Verde</option>
									<option value="KY">Cayman Islands</option>
									<option value="CF">Central African Republic</option>
									<option value="TD">Chad</option>
									<option value="CL">Chile</option>
									<option value="CN">China</option>
									<option value="CX">Christmas Island</option>
									<option value="CC">Cocos (Keeling) Islands</option>
									<option value="CO">Colombia</option>
									<option value="KM">Comoros</option>
									<option value="CG">Congo</option>
									<option value="CD">Congo, the Democratic Republic of the</option>
									<option value="CK">Cook Islands</option>
									<option value="CR">Costa Rica</option>
									<option value="CI">Côte d'Ivoire</option>
									<option value="HR">Croatia</option>
									<option value="CU">Cuba</option>
									<option value="CW">Curaçao</option>
									<option value="CY">Cyprus</option>
									<option value="CZ">Czech Republic</option>
									<option value="DK">Denmark</option>
									<option value="DJ">Djibouti</option>
									<option value="DM">Dominica</option>
									<option value="DO">Dominican Republic</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egypt</option>
									<option value="SV">El Salvador</option>
									<option value="GQ">Equatorial Guinea</option>
									<option value="ER">Eritrea</option>
									<option value="EE">Estonia</option>
									<option value="ET">Ethiopia</option>
									<option value="FK">Falkland Islands (Malvinas)</option>
									<option value="FO">Faroe Islands</option>
									<option value="FJ">Fiji</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="GF">French Guiana</option>
									<option value="PF">French Polynesia</option>
									<option value="TF">French Southern Territories</option>
									<option value="GA">Gabon</option>
									<option value="GM">Gambia</option>
									<option value="GE">Georgia</option>
									<option value="DE">Germany</option>
									<option value="GH">Ghana</option>
									<option value="GI">Gibraltar</option>
									<option value="GR">Greece</option>
									<option value="GL">Greenland</option>
									<option value="GD">Grenada</option>
									<option value="GP">Guadeloupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GG">Guernsey</option>
									<option value="GN">Guinea</option>
									<option value="GW">Guinea-Bissau</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haiti</option>
									<option value="HM">Heard Island and McDonald Islands</option>
									<option value="VA">Holy See (Vatican City State)</option>
									<option value="HN">Honduras</option>
									<option value="HK">Hong Kong</option>
									<option value="HU">Hungary</option>
									<option value="IS">Iceland</option>
									<option value="IN">India</option>
									<option value="ID">Indonesia</option>
									<option value="IR">Iran, Islamic Republic of</option>
									<option value="IQ">Iraq</option>
									<option value="IE">Ireland</option>
									<option value="IM">Isle of Man</option>
									<option value="IL">Israel</option>
									<option value="IT">Italy</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japan</option>
									<option value="JE">Jersey</option>
									<option value="JO">Jordan</option>
									<option value="KZ">Kazakhstan</option>
									<option value="KE">Kenya</option>
									<option value="KI">Kiribati</option>
									<option value="KP">Korea, Democratic People's Republic of</option>
									<option value="KR">Korea, Republic of</option>
									<option value="KW">Kuwait</option>
									<option value="KG">Kyrgyzstan</option>
									<option value="LA">Lao People's Democratic Republic</option>
									<option value="LV">Latvia</option>
									<option value="LB">Lebanon</option>
									<option value="LS">Lesotho</option>
									<option value="LR">Liberia</option>
									<option value="LY">Libya</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lithuania</option>
									<option value="LU">Luxembourg</option>
									<option value="MO">Macao</option>
									<option value="MK">Macedonia, the former Yugoslav Republic of</option>
									<option value="MG">Madagascar</option>
									<option value="MW">Malawi</option>
									<option value="MY">Malaysia</option>
									<option value="MV">Maldives</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MH">Marshall Islands</option>
									<option value="MQ">Martinique</option>
									<option value="MR">Mauritania</option>
									<option value="MU">Mauritius</option>
									<option value="YT">Mayotte</option>
									<option value="MX">Mexico</option>
									<option value="FM">Micronesia, Federated States of</option>
									<option value="MD">Moldova, Republic of</option>
									<option value="MC">Monaco</option>
									<option value="MN">Mongolia</option>
									<option value="ME">Montenegro</option>
									<option value="MS">Montserrat</option>
									<option value="MA">Morocco</option>
									<option value="MZ">Mozambique</option>
									<option value="MM">Myanmar</option>
									<option value="NA">Namibia</option>
									<option value="NR">Nauru</option>
									<option value="NP">Nepal</option>
									<option value="NL">Netherlands</option>
									<option value="NC">New Caledonia</option>
									<option value="NZ">New Zealand</option>
									<option value="NI">Nicaragua</option>
									<option value="NE">Niger</option>
									<option value="NG">Nigeria</option>
									<option value="NU">Niue</option>
									<option value="NF">Norfolk Island</option>
									<option value="MP">Northern Mariana Islands</option>
									<option value="NO">Norway</option>
									<option value="OM">Oman</option>
									<option value="PK">Pakistan</option>
									<option value="PW">Palau</option>
									<option value="PS">Palestinian Territory, Occupied</option>
									<option value="PA">Panama</option>
									<option value="PG">Papua New Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="PE">Peru</option>
									<option value="PH">Philippines</option>
									<option value="PN">Pitcairn</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar</option>
									<option value="RE">Réunion</option>
									<option value="RO">Romania</option>
									<option value="RU">Russian Federation</option>
									<option value="RW">Rwanda</option>
									<option value="BL">Saint Barthélemy</option>
									<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
									<option value="KN">Saint Kitts and Nevis</option>
									<option value="LC">Saint Lucia</option>
									<option value="MF">Saint Martin (French part)</option>
									<option value="PM">Saint Pierre and Miquelon</option>
									<option value="VC">Saint Vincent and the Grenadines</option>
									<option value="WS">Samoa</option>
									<option value="SM">San Marino</option>
									<option value="ST">Sao Tome and Principe</option>
									<option value="SA">Saudi Arabia</option>
									<option value="SN">Senegal</option>
									<option value="RS">Serbia</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leone</option>
									<option value="SG">Singapore</option>
									<option value="SX">Sint Maarten (Dutch part)</option>
									<option value="SK">Slovakia</option>
									<option value="SI">Slovenia</option>
									<option value="SB">Solomon Islands</option>
									<option value="SO">Somalia</option>
									<option value="ZA">South Africa</option>
									<option value="GS">South Georgia and the South Sandwich Islands</option>
									<option value="SS">South Sudan</option>
									<option value="ES">Spain</option>
									<option value="LK">Sri Lanka</option>
									<option value="SD">Sudan</option>
									<option value="SR">Suriname</option>
									<option value="SJ">Svalbard and Jan Mayen</option>
									<option value="SZ">Swaziland</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="SY">Syrian Arab Republic</option>
									<option value="TW">Taiwan, Province of China</option>
									<option value="TJ">Tajikistan</option>
									<option value="TZ">Tanzania, United Republic of</option>
									<option value="TH">Thailand</option>
									<option value="TL">Timor-Leste</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad and Tobago</option>
									<option value="TN">Tunisia</option>
									<option value="TR">Turkey</option>
									<option value="TM">Turkmenistan</option>
									<option value="TC">Turks and Caicos Islands</option>
									<option value="TV">Tuvalu</option>
									<option value="UG">Uganda</option>
									<option value="UA">Ukraine</option>
									<option value="AE">United Arab Emirates</option>
									<option value="GB">United Kingdom</option>
									<option value="US">United States</option>
									<option value="UM">United States Minor Outlying Islands</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistan</option>
									<option value="VU">Vanuatu</option>
									<option value="VE">Venezuela, Bolivarian Republic of</option>
									<option value="VN">Viet Nam</option>
									<option value="VG">Virgin Islands, British</option>
									<option value="VI">Virgin Islands, U.S.</option>
									<option value="WF">Wallis and Futuna</option>
									<option value="EH">Western Sahara</option>
									<option value="YE">Yemen</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabwe</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-3">
							<div class="form-group">
								<label class="form-label">State/Province</label>
								<select class="form-control">
									<option>California</option>
									<option>Alaska</option>
									<option>Alabama</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-3">
							<div class="form-group">
								<label class="form-label">City</label>
								<input class="form-control" type="text">
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-3">
							<div class="form-group">
								<label class="form-label">Postal Code</label>
								<input class="form-control" type="text">
							</div>
						</div>

						<div class="col-12 mt-4">
							<button type="button" class="btn btn-primary text-uppercase px-5">SAVE</button>
						</div>
					</form>
				</div>
			</div>
			<div class="card auth-detailblock">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">Authentication Details</h6>
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authchange"><i class="icofont-edit"></i></button>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12">
							<label class="form-label col-6 col-sm-5">User Name :</label>
							<span><strong>Adrian007</strong></span>
						</div>
						<div class="col-12">
							<label class="form-label col-6 col-sm-5">Login Password :</label>
							<span><strong>Abc*******</strong></span>
						</div>
						<div class="col-12">
							<label class="form-label col-6 col-sm-5">Last Login:</label>
							<span><strong>128.456.89 (Apple) safari</strong></span>
						</div>
						<div class="col-12">
							<label class="form-label col-6 col-sm-5">Last Password change:</label>
							<span><strong>3 Month Ago</strong></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
<!-- Edit Password-->
<div class="modal fade" id="authchange" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Authentication</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="deadline-form">
					<form>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="item1" class="form-label">User Name</label>
								<input type="text" class="form-control" id="item1" value="Adrian007">
							</div>
							<div class="col-sm-6">
								<label for="taxtno111" class="form-label">Password</label>
								<input type="password" class="form-control" id="taxtno111" value="abcxyzabc">
							</div>
							<div class="col-sm-12">
								<label for="taxtno11" class="form-label">Conform Password</label>
								<input type="text" class="form-control" id="taxtno11">
							</div>
						</div>
					</form>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit profile-->
<div class="modal fade" id="editprofile" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title  fw-bold" id="expeditLabel1111"> Edit Profile</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="deadline-form">
					<form>
						<div class="row g-3 mb-3">
							<div class="col-sm-12">
								<label for="item100" class="form-label">Name</label>
								<input type="text" class="form-control" id="item100" value="Adrian Allan">
							</div>
							<div class="col-sm-12">
								<label for="taxtno200" class="form-label">Profile</label>
								<input type="file" class="form-control" id="taxtno200">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-12">
								<label class="form-label">Details</label>
								<textarea class="form-control" rows="3">Duis felis ligula, pharetra at nisl sit amet, ullamcorper fringilla mi. Cras luctus metus non enim porttitor sagittis. Sed tristique scelerisque arcu id dignissim. Aenean sed erat ut est commodo tristique ac a metus. Praesent efficitur congue orci. Fusce in mi condimentum mauris maximus sodales. Quisque dictum est augue, vitae cursus quam finibus in. Nulla at tempus enim. Fusce sed mi et nibh laoreet consectetur nec vitae lacus.</textarea>
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label class="form-label">Country</label>
								<input type="text" class="form-control" value="California">
							</div>
							<div class="col-sm-6">
								<label for="abc1" class="form-label">Birthday date</label>
								<input type="date" class="form-control w-100" id="abc1" value="1980-03-19">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-6">
								<label for="mailid" class="form-label">Mail</label>
								<input type="text" class="form-control" id="mailid" value="adrianallan@gmail.com">
							</div>
							<div class="col-sm-6">
								<label for="phoneid" class="form-label">Phone</label>
								<input type="text" class="form-control" id="phoneid" value="202-555-0174">
							</div>
						</div>
						<div class="row g-3 mb-3">
							<div class="col-sm-12">
								<label class="form-label">Address</label>
								<textarea class="form-control" rows="3">2734 West Fork Street,EASTON 02334.</textarea>
							</div>
						</div>
					</form>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>
@endpush