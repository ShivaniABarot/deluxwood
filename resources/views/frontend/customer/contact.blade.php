<!doctype html>
<html class="no-js" lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=Edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Deluxewood Cabinetry Contact Us</title>
       <link rel="icon" href="{{asset('public/img/logo.png')}}" type="image/x-icon">
      <!-- Favicon-->
      <!-- project css file  -->
      <link rel="stylesheet" href="https://deluxewoodexpress.com/public/backend/ebazar.style.min.css">
      <link rel="stylesheet" href="https://deluxewoodexpress.com/public/backend/custom.css">
      <style type="text/css">
         .sgmn_cls 
         {
         display: flex;
         list-style: none;
         padding: 0;
         }
         .sgmn_cls li 
         {
         /*        margin-right: 20px;*/
         }
.flash-message-container {
    position: fixed;
    top: 100px;
    right: 20px;
    z-index: 9999;
}

.flash-message {
    display: inline-block;
    background-color: #d1e7dd; 
    color: #0f5132; 
    padding: 12px 20px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    opacity: 0; /* Start with opacity 0 to make it invisible initially */
    transform: translateX(100%); /* Start with slide-out animation from the right */
    transition: opacity 0.3s ease, transform 0.5s ease;
}
      </style>
   </head>
   <body style="background-color: #FBFAF6;">
      <div id="ebazar-layout" class="theme-blue">
         <!-- main body area -->
         <div class="main p-2 py-3 p-xl-5 ">
            <div class="col-lg-12 row">
               <div class="col-lg-10"></div>
               <div class="col-lg-2">
                  <ul class="sgmn_cls">
                     <li>
                        <a class="nav-link collapsed font-weight-bold" href="#" title="Get Help" style="color: #101010;">
                        Contact
                        </a>
                     </li>
                     <li>
                        <a class="nav-link collapsed font-weight-bold" href="{{url('about')}}" title="Get Help" style="color: #101010;">
                        About Us
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
               @if(Auth::check() && Auth::user()->role_id == 1) 
               <a href="{{url('admin/home')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
               <span class="logo-icon">
               <img src="{{asset('public/logo.png')}}" height="60" style="width:auto">
               </span>
               </a>
               @elseif(Auth::check() && Auth::user()->role_id == 2) 
               <a href="{{url('dashboard')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
               <span class="logo-icon">
               <img src="{{asset('public/logo.png')}}" height="60" style="width:auto">
               </span>
               </a>
               @else
               <a href="{{url('/home')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
               <span class="logo-icon">
               <img src="{{asset('public/logo.png')}}" height="60" style="width:auto">
               </span>
               </a>
               @endif 
               <div class="container-xxl">
                  <div class="row g-0">
                     <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
                        <div class="w-100 p-3 p-md-5 card" style="max-width: 50rem; border-radius: 25px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px!important;">
                           <!-- Form -->
                                 <div class="flash-message-container">
                                     @if(session('success'))
                                         <div class="flash-message">{{ session('success') }}</div>
                                     @endif
                                 </div>             
                           <form class="row " action="{{url('contact/store')}}"  method="POST" id="contactForm">
                              @csrf
                              <div class="col-12 text-center mb-5">
                                 <h1>Contact Us Now</h1>
                                 <span>Refined Products for Refined Taste</span>
                              </div>
                              <div class="col-6">
                                 <div class="mb-2">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="contact_name"class="form-control form-control-sm" placeholder="Enter your name">
                                    <span class="text-danger kt-form__help error contact_name"></span>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="mb-2">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="contact_email" class="form-control form-control-sm" placeholder="Enter your email">
                                    <span class="text-danger kt-form__help error contact_email"></span>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="mb-2">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" name="contact_no"class="form-control form-control-sm" placeholder="Enter your contact number">
                                    <span class="text-danger kt-form__help error contact_no"></span>
                                 </div>
                              </div>
                               <div class="col-6">
                                 <div class="mb-2">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject"class="form-control form-control-sm" placeholder="Enter your subject">
                                    <span class="text-danger kt-form__help error subject"></span>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="mb-2">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control form-control-sm" rows="3" name="message" placeholder="Enter your message" style="resize: none;"></textarea>
                                    <span class="text-danger kt-form__help error message"></span>
                                 </div>
                              </div>
                              <div class="col-12 text-center mt-4">
                                 <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" alt="SIGNUP">Send Message</button>
                              </div>

                           </form>
                           <!-- End Form -->

                        </div>

                     </div>
                  </div>

                  <!-- End Row -->
               </div>

            </div>
            <div class="col-lg-12 row" style="padding-left: 20px;">
                 <!-- <div class="col-lg-1"></div> -->
                     <div class="col-lg-12">
            <div class="row g-3 mb-4 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">
      <div class="col">
         <div class="alert-success alert mb-0">
            <div class="d-flex align-items-center">
               <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></div>
               <div class="flex-fill ms-3 text-truncate">
                  <!-- <div class="h6 mb-0">Order Created at</div> -->
                  <span class="small">420 Frontage Rd, West Haven, CT 065 16</span>
               </div>
            </div>
         </div>
      </div>
     
      <div class="col">
         <div class="alert-warning alert mb-0">
            <div class="d-flex align-items-center">
               <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></div>
               <div class="flex-fill ms-3 text-truncate">
                  <!-- <div class="h6 mb-0">Email</div> -->
                  <span class="small">Deluxewoodcabinetry@gmail.com</span>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="alert-info alert mb-0">
            <div class="d-flex align-items-center">
               <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i></div>
               <div class="flex-fill ms-3 text-truncate">
                  <!-- <div class="h6 mb-0">Contact No</div> -->
                  <span class="small">+1 (475)655-2687 <br>+1 (475)655-2693</span>
               </div>
            </div>
         </div>
      </div>
   </div> </div> </div>
    <div class="google-map-area">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <!-- <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=melbourne,%20Australia&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe> -->
                    <div style="overflow:hidden;resize:none;max-width:100%;width:100%;height:500px;"><div id="gmapcanvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://maps.google.com/maps?q=420 Frontage Rd, West Haven, CT 065 16&t=&z=10&ie=UTF8&iwloc=&output=embed"></iframe></div><a class="embed-maphtml" href="https://www.embed-map.com" id="enable-mapdata">https://www.embed-map.com</a><style>#gmapcanvas .text-marker{}.map-generator{max-width: 100%; max-height: 100%; background: none;}</style></div>
                </div>
            </div>
        </div>
         </div>
      </div>
      <script src="https://deluxewoodexpress.com/public/backend/dist/assets/bundles/libscripts.bundle.js"></script>
      <script type="text/javascript" src="{{asset('public/validation/ContactFormValidation.js')}}"></script> 




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

    // Call the showFlashMessage function when the page loads
    document.addEventListener('DOMContentLoaded', function () {
        showFlashMessage();
    });
</script>
   </body>
</html>