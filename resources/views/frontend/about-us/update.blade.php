<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Deluxewood Cabinetry About Us</title>
    <link rel="icon" href="https://deluxewoodexpress.com/favicon.ico" type="image/x-icon">
    <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="https://deluxewoodexpress.com/public/backend/ebazar.style.min.css">
    <link rel="stylesheet" href="https://deluxewoodexpress.com/public/backend/custom.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style type="text/css">
        .sgmn_cls {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .sgmn_cls li {
        }
        #editor {
        width: 100%;
        height: 250px;
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
                            <a class="nav-link collapsed font-weight-bold" href="{{url('contact-us')}}" title="Get Help"
                                style="color: #101010;">
                                Contact
                            </a>
                        </li>
                        <li>
                            <a class="nav-link collapsed font-weight-bold" href="" title="Get Help"
                                style="color: #101010;">
                                About Us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <a href="{{url('admin/home')}}" class="mb-0 brand-icon"
                    style="text-align: center; padding-bottom: 25px;">
                    <span class="logo-icon">
                        <img src="{{asset('public/logo.png')}}" height="60" style="width:auto">
                    </span>
                </a>
                <div class="container-xxl">
                    <div class="row g-0">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
                            <div class="w-100 p-3 p-md-5" style="max-width: 143rem;">
                                <!-- Form -->
                              <form action="{{url('about-us/update')}}\{{$about->about_id}}" method="POST" id="customergroupForm">
                                @method('PATCH')
                                @csrf
                                <h1 class="text-center">About Us</h1>
                                <div class="mb-3 pt-3 card" style="font-size: 16px;">
                                    <p class="text-center" style="padding-top: 15px;"><b>Refined Products for Refined
                                            Taste</b></p>
                                    <p class="text-center"><b> Product offerings: Modern & Traditional Style Cabinets, All
                                            Wood Construct</b></p>

                                    <div class="card-body" style="padding: 40px;">
                                    <!-- <textarea id="mytextarea"  name="about_content">{{$about->content}}</textarea> -->
                                    <textarea name="content" id="editor" rows="10" cols="80">{{$about->content}}</textarea>
                                    <!-- <button onclick="separateParagraphs()">Separate Paragraphs</button> -->
                                    <!-- <div id="paragraphContainer"></div> -->
                                    <!-- <p>Deluxe Wood Cabinetry is a family-owned business based in West Haven Connecticut and is equipped with an innovative team of highly motivated professionals who strive for only excellence, outstanding quality, and exceptional service.
                                           
                                           </p>
                                           <p class="mb-2"><strong>Please Note :</strong></p>
                                           <p>A two-week lead time on all in-stock door styles as well as a fixed low-cost shipping price to local and neighbouring states is the standard of efficiency. There is also a variety of door styles to choose from ranging between contemporary, modern, and transitional.</p>
                                           <p>Buyers have the option of purchasing cabinets assembled or unassembled by our warehouse team who is relentless in achieving the highest quality production for customer satisfaction. Also, our help desk and customer support team share the same drive for excellence as they are knowledgeable, patient, warm, and ready to serve all your customer needs.</p>
                                           <p>Expanding throughout the east coast, Deluxe Wood Cabinetry continues to find new and exciting ways to improve their product and quality as well as customer satisfaction.</p>-->
                                       
                                        <button class="btn btn-warning mt-4 text-uppercase px-5" type="submit" style="margin-top: 16px;">Save</button>
                                         
                                </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
            </div>
        </div>
    </div>
   
 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('public/validation/ContactFormValidation.js')}}"></script>
    <!-- <script type="text/javascript" src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script> -->
    <script type="text/javascript" src=" https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            // Additional configuration can be added here
            editor: {
                toolbar: {
                    // Custom toolbar options
                }
            }
        })
        .then(editor => {
            editor.ui.view.editable.element.style.width = '100%';
            editor.ui.view.editable.element.style.height = '250px';
        })
        .catch(error => {
            console.error(error);
        });
</script>
    <script type="text/javascript">
        
   $(document).ready(function(){
     CKEDITOR.replace('mytextarea',{
   
     width: "100%",
     height: "250px"
   
     }); 
     CKEDITOR.replace('mytextarea2',{
   
       width: "100%",
       height: "250px"
   
       }); 
       $('textarea').each(function(){
               $(this).val($(this).val().trim());
           }
       );
   }); 
    </script>
</body>

</html>
