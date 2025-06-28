<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Deluxewood Cabinetry About Us</title>
     <link rel="icon" href="{{asset('public/img/logo.png')}}" type="image/x-icon">
    <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="https://deluxewoodexpress.com/public/backend/ebazar.style.min.css">
    <link rel="stylesheet" href="https://deluxewoodexpress.com/public/backend/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
        .sgmn_cls {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .sgmn_cls li {
            /*        margin-right: 20px;*/
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
                <a href="{{url('/')}}" class="mb-0 brand-icon"
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
                                <h1 class="text-center">About Us</h1>
                                <div class="mb-3 pt-3 card" style="font-size: 16px;">
                                    <p class="text-center" style="padding-top: 15px;"><b>Refined Products for Refined
                                            Taste</b></p>
                                    <p class="text-center"><b> Product offerings: Modern & Traditional Style Cabinets, All
                                            Wood Construct</b></p>

                                    <div class="card-body" style="padding: 40px;">
                                    <p>Deluxe Wood Cabinetry is a family-owned business based in West Haven Connecticut and is equipped with an innovative team of highly motivated professionals who strive for only excellence, outstanding quality, and exceptional service.
                                           
                                           </p>
                                           <!-- <p class="mb-2"><strong>Please Note :</strong></p> -->
                                           <p>A two-week lead time on all in-stock door styles as well as a fixed low-cost shipping price to local and neighbouring states is the standard of efficiency. There is also a variety of door styles to choose from ranging between contemporary, modern, and transitional.</p>
                                           <p>Buyers have the option of purchasing cabinets assembled or unassembled by our warehouse team who is relentless in achieving the highest quality production for customer satisfaction. Also, our help desk and customer support team share the same drive for excellence as they are knowledgeable, patient, warm, and ready to serve all your customer needs.</p>
                                           <p>Expanding throughout the east coast, Deluxe Wood Cabinetry continues to find new and exciting ways to improve their product and quality as well as customer satisfaction.</p>
                                    
                                </div>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add Modal -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Paragraph</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <input type="text" id="newParagraphText" class="form-control" placeholder="Enter paragraph text">
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addParagraph()">Add
                        Paragraph</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal" id="updateModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Paragraph</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <input type="text" id="updatedParagraphText" class="form-control" placeholder="Enter updated text">
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateParagraph()">Update
                        Paragraph</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Remove Modal -->
    <div class="modal" id="removeModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Remove Paragraph</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p>Are you sure you want to remove the paragraph?</p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="removeParagraph()">Remove
                        Paragraph</button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('public/validation/ContactFormValidation.js')}}"></script>
    <script>
    // Array to store paragraphs
    const paragraphs = [];

    // Function to add a new paragraph
    function addParagraph() {
        const newParagraph = document.getElementById('newParagraph').value;
        paragraphs.push(newParagraph);
        displayParagraphs();
    }

    // Function to display paragraphs
    function displayParagraphs() {
        const container = document.getElementById('paragraphContainer');
        container.innerHTML = '';

        // Display each paragraph with update and delete buttons
        paragraphs.forEach((paragraph, index) => {
            const paragraphDiv = document.createElement('div');
            paragraphDiv.innerHTML = `
                <p>${paragraph}</p>
                <button class="btn btn-primary" type="button" onclick="updateParagraph(${index})">Update</button>
                <button class="btn btn-primary" type="button" onclick="deleteParagraph(${index})">Delete</button>
            `;
            container.appendChild(paragraphDiv);
        });
    }

    // Function to update a paragraph
    function updateParagraph(index) {
        const updatedParagraph = prompt('Enter updated paragraph:', paragraphs[index]);
        if (updatedParagraph !== null) {
            paragraphs[index] = updatedParagraph;
            displayParagraphs();
        }
    }

    // Function to delete a paragraph
    function deleteParagraph(index) {
        paragraphs.splice(index, 1);
        displayParagraphs();
    }

    // Initial display
    displayParagraphs();
</script>
</body>

</html>
