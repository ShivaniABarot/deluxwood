<!doctype html>
<html class="no-js" lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=Edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Deluxewood Cabinetry @yield('title')</title>
      <link rel="icon" href="{{asset('public/img/logo.png')}}" type="image/x-icon">
      <!-- Favicon-->
      @stack('styles')
      <!-- project css file  -->
      <link rel="stylesheet" href="{!! backendAssets('ebazar.style.min.css') !!}">
      <link rel="stylesheet" href="{!! backendAssets('custom.css') !!}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icofont/4.5.0/css/icofont.min.css">
      <style type="text/css">
         .flash-message-container {
         position: fixed;
         top: 150px;
         right: 40px;
         z-index: 9999;
         }
         .flash-message {
         display: inline-block;
         background-color: #d1e7dd; 
         color: #0f5132; 
         padding: 12px 20px;
         border-radius: 4px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         opacity: 0; 
         transform: translateX(100%); 
         transition: opacity 0.3s ease, transform 0.5s ease;
         }
         .flash-message-error
         {
         display: inline-block;
         background-color: #f5c2c7; 
         color: #f5c2c7; 
         padding: 12px 20px;
         border-radius: 4px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         opacity: 0; 
         transform: translateX(100%); 
         transition: opacity 0.3s ease, transform 0.5s ease;
         }
         .ntf_cls {
         font-size: 10px;
         position: absolute;
         top: -1px;
         right: 3px;
         padding: 5px 10px;
         background-color: red;
         color: white;
         border-radius: 50%;
         font-weight: 900;
         }
         .unseen-message 
         {
         border-radius: 8px; 
         transition: background-color 0.3s ease;
         }
         .seen-message
         {
         padding: 10px;
         }
         .sidebar .menu-list{
         overflow-x: hidden;
/*         overflow-y: hidden ;*/
         }
         .ftbd_cls
         {
         font-weight: 600;
         }
         .dot {
         display: inline-block;
         width: 7px;
         height: 7px;
         background-color: #dca53e;
         border-radius: 50%;
         }
         .h-right .user-profile .dropdown-menu .card.w280
         {
            width: 315px;
         }
      </style>
      @stack('custom_styles')
   </head>
   <body>
      <!-- Body: Header -->
      <div class="header">
         <nav class="navbar py-4" style="background-color: #FBFAF6; height: 72px;">
            <div class="container-xxl">
               <!-- header rightbar icon -->
               <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                  <div class="d-flex">
                     <a class="nav-link collapsed font-weight-bold" href="{{url('contact-us')}}" title="Get Help" style="color: #101010;">
                     Contact
                     </a>
                  </div>
                  <div class="d-flex">
                     <a class="nav-link collapsed font-weight-bold" href="{{url('about')}}" title="Get Help" style="color: #101010;">
                     About Us
                     </a>
                  </div>
                  <div class="dropdown zindex-popover">
                     <!-- <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{!! backendAssets('dist/assets/images/flag/GB.png') !!}" alt="">
                        </a> -->
                     <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
                        <div class="card border-0">
                           <ul class="list-unstyled py-2 px-3">
                              <li>
                                 <a href="#" class=""><img src="{!! backendAssets('dist/assets/images/flag/GB.png') !!}" alt=""> English</a>
                              </li>
                              <li>
                                 <a href="#" class=""><img src="{!! backendAssets('dist/assets/images/flag/DE.png') !!}" alt=""> German</a>
                              </li>
                              <li>
                                 <a href="#" class=""><img src="{!! backendAssets('dist/assets/images/flag/FR.png') !!}" alt=""> French</a>
                              </li>
                              <li>
                                 <a href="#" class=""><img src="{!! backendAssets('dist/assets/images/flag/IT.png') !!}" alt=""> Italian</a>
                              </li>
                              <li>
                                 <a href="#" class=""><img src="{!! backendAssets('dist/assets/images/flag/RU.png') !!}" alt=""> Russian</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  @if(Auth::user()->role_id == 1 ||  Auth::user()->role_id == 3 )
                  <div class="dropdown notifications">
                     <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                     <i class="icofont-alarm fs-5">
                     @if($unseen > 0)
                     <span class="badge bg-danger ntf_cls">{{$unseen}}</span>
                     @endif
                     </i>
                     <span class="pulse-ring"></span>
                     </a>
                     <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
                        <div class="card border-0 w380">
                           <div class="card-header border-0 p-3">
                              <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                 <span>Notifications</span>
                                 <span class="badge text-white">{{ sprintf('%02d', $countQuotation) }}</span>
                              </h5>
                           </div>
                           <div class="tab-content card-body">
                              <div class="tab-pane fade show active">
                                 <ul class="list-unstyled list mb-0">
                                    @foreach($drafts as $val)
                                    @if($val->is_seen == '0')
                                    <li class="py-2 mb-1 border-bottom unseen-message">
                                       @if(Auth::user()->role_id == 1)
                                       <a href="{{ url('admin/process-manage-view', $val->customer_draft_id) }}" class="d-flex position-relative">
                                       @else
                                       <a href="{{ url('process-manage-view', $val->customer_draft_id) }}" class="d-flex position-relative">
                                       @endif
                                      
                                          @if(!empty($val['company_logo']))
                                          <img class="avatar rounded-circle" src="{{ asset('public/img/companyLogo/'.$val['company_logo']) }}" alt="">
                                          @else
                                          <img class="avatar rounded-circle" src="{!! backendAssets('dist/assets/images/xs/avatar5.svg') !!}" alt="">
                                          @endif
                                          <div class="flex-fill ms-2">
                                             <div class="d-flex justify-content-between align-items-end">
                                                <div class="text-start">
                                                   <span class="font-weight-bold">{{ $val->representative_name }}</span>
                                                </div>
                                                <div class="text-end">
                                                   <span class="dot"></span>
                                                </div>
                                             </div>
                                             <div class="d-flex justify-content-between align-items-end">
                                                <div class="text-start">
                                                   <span class="ftbd_cls">Product Order to </span>
                                                </div>
                                                <div class="text-end">
                                                   <small class="ftbd_cls d-block">{{ \Carbon\Carbon::parse($val->created_at)->diffForHumans() }}</small>
                                                </div>
                                             </div>
                                          </div>
                                       </a>
                                    </li>
                                    @else
                                    <li class="py-2 mb-1 border-bottom seen">
                                       @if(Auth::user()->role_id == 1)
                                       <a href="{{url('admin/process-manage-view')}}\{{$val->customer_draft_id }}" class="d-flex ">
                                       @else
                                       <a href="{{url('process-manage-view')}}\{{$val->customer_draft_id }}" class="d-flex ">
                                       @endif
                                       
                                          @if(!empty($val['company_logo']))
                                          <img class="avatar rounded-circle" src="{{ asset('public/img/companyLogo/'.$val['company_logo']) }}" alt="">
                                          @else
                                          <img class="avatar rounded-circle" src="{!! backendAssets('dist/assets/images/xs/avatar5.svg') !!}" alt="">
                                          @endif
                                          <div class="flex-fill ms-2">
                                             <span>{{ $val->representative_name }}</span>
                                             <div class="d-flex justify-content-between align-items-end">
                                                <div class="text-start">
                                                   <span class="">Product Order to </span>
                                                </div>
                                                <div class="text-end">
                                                   <small class=" d-block">{{ \Carbon\Carbon::parse($val->created_at)->diffForHumans() }}</small>
                                                </div>
                                             </div>
                                          </div>
                                       </a>
                                    </li>
                                    @endif
                                    @endforeach
                                 </ul>
                              </div>
                           </div>
                           <a class="card-footer text-center border-top-0" href="{{url('admin/process-manage')}}"> View all notifications</a>
                        </div>
                     </div>
                  </div>
                  @endif
                  @if(Auth::user() != "" )
                  @if(Auth::user()->role_id == 1 )
                  <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                     <div class="u-info me-2">
                        <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">{{Auth::user()->name}}</span></p>
                        <small>Admin Profile</small>
                     </div>
                     <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                     <img class="avatar lg rounded-circle img-thumbnail" src="{{ backendAssets('dist/assets/images/profile_av.svg') }}" alt="profile">

                     </a>
                     <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                        <div class="card border-0 w280">
                           <div class="card-body pb-0">
                              <div class="d-flex py-1">
                              <img class="avatar lg rounded-circle img-thumbnail" src="{{ backendAssets('dist/assets/images/profile_av.svg') }}" alt="profile">

                                 <div class="flex-fill ms-3">
                                    <p class="mb-0"><span class="font-weight-bold">{{Auth::user()->name}}</span></p>
                                    <small class="">{{Auth::user()->email}}</small>
                                 </div>
                              </div>
                              <div>
                                 <hr class="dropdown-divider border-dark">
                              </div>
                           </div>
                           <div class="list-group m-2 ">
                              <a href="{!! backendRoutePut('admin-profile') !!}" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user fs-5 me-3"></i>Profile Page</a>
                              <a href="{{url('admin/reset_password')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-lock fs-5 me-3"></i>Change Password</a>
                              <!-- <a href="{!! backendRoutePut('order-invoices') !!}" class="list-group-item list-group-item-action border-0 "><i class="icofont-file-text fs-5 me-3"></i>Order Invoices</a> -->
                              <a href="{{url('/logout')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-5 me-3"></i>Signout</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @elseif(Auth::user()->role_id == 3  )
                  <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                     <div class="u-info me-2">
                        <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">{{Auth::user()->name}}</span></p>
                        <small>Account Manager </small>
                     </div>
                     <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                     <img class="avatar lg rounded-circle img-thumbnail" src="{{ backendAssets('dist/assets/images/profile_av.svg') }}" alt="profile">

                     </a>
                     <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                        <div class="card border-0 w280">
                           <div class="card-body pb-0">
                              <div class="d-flex py-1">
                              <img class="avatar rounded-circle" src="{{ backendAssets('dist/assets/images/profile_av.svg') }}" alt="profile">

                                 <div class="flex-fill ms-3">
                                    <p class="mb-0"><span class="font-weight-bold">{{Auth::user()->name}}</span></p>
                                    <small class="">{{Auth::user()->email}}</small>
                                 </div>
                              </div>
                              <div>
                                 <hr class="dropdown-divider border-dark">
                              </div>
                           </div>
                           <div class="list-group m-2 ">
                              <a href="{{url('account_manager/profile')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user fs-5 me-3"></i>Profile Page</a>
                            
                              <!-- <a href="{!! backendRoutePut('order-invoices') !!}" class="list-group-item list-group-item-action border-0 "><i class="icofont-file-text fs-5 me-3"></i>Order Invoices</a> -->
                              <a href="{{url('/logout')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-5 me-3"></i>Signout</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @else
                  @php $customer=  DB::table('customer')->where('user_id', Auth::user()->id)->first(); @endphp
                  <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                     <div class="u-info me-2">
                        <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">{{Auth::user()->name}}</span></p>
                        <small>Customer Profile</small>
                     </div>
                     <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                     @if($customer->company_logo != null)
                     <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('public/img/companyLogo/'.$customer->company_logo)}}" alt="profile">
                     @else
                     <img class="avatar lg rounded-circle img-thumbnail" src="{{ asset('img/companyLogo/default-logo.jpg') }}" alt="Profile" loading="lazy" />

                     @endif
                     </a>
                     <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                        <div class="card border-0 w280">
                           <div class="card-body pb-0">
                              <div class="d-flex py-1">
                                 @if($customer->company_logo != null)
                                 <img class="avatar rounded-circle" src="{{ asset('public/img/companyLogo/' . $customer->company_logo) }}" alt="profile">
                                 @else
                                 <img class="avatar lg rounded-circle img-thumbnail" src='{{asset("public/img/companyLogo/default-logo.jpg")}}' alt="profile"/>
                                 @endif
                                 <div class="flex-fill ms-3">
                                    <p class="mb-0"><span class="font-weight-bold">{{Auth::user()->name}}</span></p>
                                    <small class="">{{Auth::user()->email}}</small>
                                 </div>
                              </div>
                              <div>
                                 <hr class="dropdown-divider border-dark">
                              </div>
                           </div>
                           <div class="list-group m-2 ">
                              <a href="{{url('customer_edit_profile/view')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user fs-5 me-3"></i>Profile Page</a>
                              <!-- <a href="{!! backendRoutePut('order-invoices') !!}" class="list-group-item list-group-item-action border-0 "><i class="icofont-file-text fs-5 me-3"></i>Order Invoices</a> -->
                              <a href="{{url('/logout')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-5 me-3"></i>Signout</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif   
                  @else
                  <div class="setting ms-2">
                     <h6 style="margin-right:10px;"><a href="{{url('/login')}}" ><i class="icofont-login fs-5 me-3" style="margin-right:0px;"></i>Login</a></h6>
                  </div>
                  @endif
                  <!-- <div class="setting ms-2">
                     <a href="#" data-bs-toggle="modal" data-bs-target="#Settingmodal"><i class="icofont-gear-alt fs-5"></i></a>
                     </div> -->
               </div>
               <!-- menu toggler -->
               <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
               <span class="fa fa-bars"></span>
               </button>
               <!-- main menu Search-->
               <a href="{!! backendRoutePut('home') !!}" class="mb-0 brand-icon">
               <span class="logo-icon">
               <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 50px; width: auto; margin-left: 52px;">
                  </span>
               </a>
            </div>
         </nav>
      </div>
      <div id="ebazar-layout" class="theme-blue">
         @if(Auth::user() != ""  && Auth::user()->role_id == 1 ||  Auth::user()->role_id == 3)
         @include(backendView('includes.sidebar'))
         @else 
         @include(backendView('includes.customer_sidebar'))
         @endif
         <!-- main body area -->
         <div class="main px-lg-4 px-md-4">
            @include(backendView('includes.header'))
            <!-- Body: Body -->
            <div class="body d-flex py-3">
               @yield('content')
            </div>
            @yield('footer')
            <!-- Modal Custom Settings-->
            <!-- <div class="modal fade right" id="Settingmodal" tabindex="-1" aria-hidden="true">
               <div class="modal-dialog  modal-sm">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Custom Settings</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body custom_setting">
                        
                        <div class="setting-theme pb-3">
                           <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-color-bucket fs-4 me-2 text-primary"></i>Template Color Settings</h6>
                           <ul class="list-unstyled row row-cols-3 g-2 choose-skin mb-2 mt-2">
                              <li data-theme="indigo">
                                 <div class="indigo"></div>
                              </li>
                              <li data-theme="tradewind">
                                 <div class="tradewind"></div>
                              </li>
                              <li data-theme="monalisa">
                                 <div class="monalisa"></div>
                              </li>
                              <li data-theme="blue" class="active">
                                 <div class="blue"></div>
                              </li>
                              <li data-theme="cyan">
                                 <div class="cyan"></div>
                              </li>
                              <li data-theme="green">
                                 <div class="green"></div>
                              </li>
                              <li data-theme="orange">
                                 <div class="orange"></div>
                              </li>
                              <li data-theme="blush">
                                 <div class="blush"></div>
                              </li>
                              <li data-theme="red">
                                 <div class="red"></div>
                              </li>
                           </ul>
                        </div>
                        <div class="sidebar-gradient py-3">
                           <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-paint fs-4 me-2 text-primary"></i>Sidebar Gradient</h6>
                           <div class="form-check form-switch gradient-switch pt-2 mb-2">
                              <input class="form-check-input" type="checkbox" id="CheckGradient">
                              <label class="form-check-label" for="CheckGradient">Enable Gradient! ( Sidebar )</label>
                           </div>
                        </div>
                        
                        <div class="dynamic-block py-3">
                           <ul class="list-unstyled choose-skin mb-2 mt-1">
                              <li data-theme="dynamic">
                                 <div class="dynamic"><i class="icofont-paint me-2"></i> Click to Dyanmic Setting</div>
                              </li>
                           </ul>
                           <div class="dt-setting">
                              <ul class="list-group list-unstyled mt-1">
                                 <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label>Primary Color</label>
                                    <button id="primaryColorPicker" class="btn bg-primary avatar xs border-0 rounded-0"></button>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label>Secondary Color</label>
                                    <button id="secondaryColorPicker" class="btn bg-secondary avatar xs border-0 rounded-0"></button>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 1</label>
                                    <button id="chartColorPicker1" class="btn chart-color1 avatar xs border-0 rounded-0"></button>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 2</label>
                                    <button id="chartColorPicker2" class="btn chart-color2 avatar xs border-0 rounded-0"></button>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 3</label>
                                    <button id="chartColorPicker3" class="btn chart-color3 avatar xs border-0 rounded-0"></button>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 4</label>
                                    <button id="chartColorPicker4" class="btn chart-color4 avatar xs border-0 rounded-0"></button>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 5</label>
                                    <button id="chartColorPicker5" class="btn chart-color5 avatar xs border-0 rounded-0"></button>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        
                        <div class="setting-font py-3">
                           <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-font fs-4 me-2 text-primary"></i> Font Settings</h6>
                           <ul class="list-group font_setting mt-1">
                              <li class="list-group-item py-1 px-2">
                                 <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-poppins" value="font-poppins">
                                    <label class="form-check-label" for="font-poppins">
                                       Poppins Google Font
                                    </label>
                                 </div>
                              </li>
                              <li class="list-group-item py-1 px-2">
                                 <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-opensans" value="font-opensans" checked="">
                                    <label class="form-check-label" for="font-opensans">
                                       Open Sans Google Font
                                    </label>
                                 </div>
                              </li>
                              <li class="list-group-item py-1 px-2">
                                 <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-montserrat" value="font-montserrat">
                                    <label class="form-check-label" for="font-montserrat">
                                       Montserrat Google Font
                                    </label>
                                 </div>
                              </li>
                              <li class="list-group-item py-1 px-2">
                                 <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-mukta" value="font-mukta">
                                    <label class="form-check-label" for="font-mukta">
                                       Mukta Google Font
                                    </label>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     
                        <div class="setting-mode py-3">
                           <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-layout fs-4 me-2 text-primary"></i>Contrast Layout</h6>
                           <ul class="list-group list-unstyled mb-0 mt-1">
                              <li class="list-group-item d-flex align-items-center py-1 px-2">
                                 <div class="form-check form-switch theme-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-switch">
                                    <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                                 </div>
                              </li>
                              <li class="list-group-item d-flex align-items-center py-1 px-2">
                                 <div class="form-check form-switch theme-high-contrast mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                    <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                                 </div>
                              </li>
                              <li class="list-group-item d-flex align-items-center py-1 px-2">
                                 <div class="form-check form-switch theme-rtl mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-rtl">
                                    <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="modal-footer justify-content-start">
                        <button type="button" class="btn btn-white border lift" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary lift">Save Changes</button>
                     </div>
                  </div>
               </div>
               </div> -->
            @stack('modals')
         </div>
      </div>
      <!-- Jquery Core Js -->
      <script src="{!! backendAssets('dist/assets/bundles/libscripts.bundle.js') !!}"></script>
      @stack('scripts')
      <script>
         // Function to show the flash message and slide in from the right
         function showFlashMessage() {
             var flashMessage = document.querySelector('.flash-message');
             flashMessage.style.opacity = '1';
             flashMessage.style.transform = 'translateX(0)'; // Slide-in from the right
         
             // After 5 seconds, slide out to the right and hide the flash message
             setTimeout(function () {
                 flashMessage.style.opacity = '0';
                 flashMessage.style.transform = 'translateX(100%)'; // Slide-out to the right
             }, 3000); // Adjust the delay time (in milliseconds) as needed
         }
   
         document.addEventListener('DOMContentLoaded', function () {
             showFlashMessage();
         });
      </script>
      <!-- Jquery Page Js -->
      <script src="{!! backendAssets('dist/assets/js/template.js') !!}"></script>
      <!-- Select2 -->
      <script src="{{ asset('asset/plugin/select2/js/select2.full.min.js')}}"></script>
      <script>
         $(document).ready(function() {
         $('.js-example-basic-multiple').select2();});
             
      </script>
      <script>
         window.onunload = function(){};
         if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
             location.reload();
         }
      </script>
      @stack('custom_scripts')
   </body>
</html>