@extends(backendView('layouts.app'))
@section('title', 'Specbook')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0"> SpecBook</h3>
             @if($specbook_pdf)
                <a href="{{ asset('public/img/specbook/' . $specbook_pdf->pdf) }}" class="btn btn-dark py-2 px-5 btn-set-task w-sm-100" download>
                    <i class="icofont-download me-2 fs-6"></i> Download
                </a>
          
            @endif
         </div>
      </div>
   </div>
   <!-- Row end  -->
   <div class="row clearfix g-3">
      <div class="col-lg-12">
         <div class="card mb-3">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
               <h6 class="m-0 fw-bold"></h6>
            </div>
            <div class="card-body">
               <form action="{{url('specbook') }}" method="POST" id="comparison-form">
                  @csrf
                  <div class="row g-3 align-items-center">
                     @if(($product1===null) &&($product2===null))
                     <div class="col-md-6">
                        <label class="form-label">Choose First Product <span class="text-danger">*</span></label>
                        <select class="form-control category" id="first_selected_dropdown" name="first">
                           <option value="0">Please Select</option>
                           @foreach($draft as $data)
                           <option value="{{ $data['draft_product_id'] }}">{{$data['product_name']}}</option>
                           @endforeach
                        </select>
                        @if(old('first') === '0')
                        <div class="alert alert-danger">Please select a valid option.</div>
                        @endif
                        <input type="text" name="first_selected" id="first_selected" hidden>
                        <span class="text-danger kt-form__help error first_selected"></span>
                        <input type="text" name="first_selected_name" id="first_selected_name" hidden>
                     </div>
                     <div class="col-6">
                        <label class="form-label">Choose Second Product <span class="text-danger">*</span></label>
                        <select class="form-control category" id="second_selected_dropdown" name="second">
                           <option value="0">Please Select</option>
                           @foreach($draft as $data)
                           <option value="{{ $data['draft_product_id'] }}">{{$data['product_name']}}</option>
                           @endforeach
                        </select>
                        @if(old('second') === '0')
                        <div class="alert alert-danger">Please select a valid option.</div>
                        @endif
                        <input type="text" name="second_selected" id="second_selected" hidden>
                        <span class="text-danger kt-form__help error second_selected"></span>
                        <input type="text" name="second_selected_name" id="second_selected_name" hidden>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Compare</button>
                  <div class="row" id="category_div" style=" margin-top:30px;">
                     @php
                     $count = 0;
                     @endphp
                     <div class="row col-12">
                        <div class="col-lg-5 col-md-12">
                           <div class="card">
                              <div class="card-header py-3 d-flex align-items-center bg-transparent border-bottom-0 justify-content-center ct_cls">
                                 <h5 class="m-0 fw-bold">Category</h5>
                              </div>
                              <div class="card-body">
                                 <div class="table-responsive">
                                    <table class="table">
                                       <hr>
                                       <tbody>
                                         @foreach ($category as $index => $categories)
                                            <tr>
                                                <td>
                                                    <input type="radio" name="product_category" id="categories{{ $categories->category_id }}" value="{{ $categories->category_id }}">
                                                    <label for="categories{{ $categories->category_id }}">{{ $categories->title }}</label>
                                                </td>
                                            </tr>
                                        @endforeach
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-7" id="get_cat_products">
                         
                        </div>
                        <!-- <label class="form-label">Category</label>
                           <div class="col-4">
                               <div class="mb-2">
                                   @foreach($category as  $index =>$categories)
                                       <input type="radio" name="category" id="categories{{ $categories->category_id }}" value="{{ $categories->category_id }}" @if($index < 10) checked @endif>
                                       <label for="categories{{ $categories->category_id }}">{{ $categories->title }}</label><br>
                                   @endforeach
                                   </div>
                            </div> -->
                     </div>
                  </div>
            </div>
            </form>
            @else    
            <div class="col-md-6">
               <label class="form-label">First Product</label>
               <select class="form-control category" id="first_selected_dropdown" name="first">
                  <option value="" selected>{{$selectedProduct_first}}</option>
                  <!-- @foreach($draft as $data)
                     <option value="{{ $data->draft_product_id }}">{{$data->product_name}}</option>
                     @endforeach -->
               </select>
               @if(old('first') === '0')
               <div class="alert alert-danger">Please select a valid option.</div>
               @endif
               <input type="text" name="first_selected" id="first_selected" hidden>
               <input type="text" name="first_selected_name" id="first_selected_name" hidden>
            </div>
            <div class="col-6">
               <label class="form-label">Second Product </label>
               <select class="form-control category" id="second_selected_dropdown" name="second">
                  <option value="" selected>{{$selectedProduct_second}}</option>
                  <!-- @foreach($draft as $data)
                     <option value="{{ $data->draft_product_id }}">{{$data->product_name}}</option>
                     @endforeach -->
               </select>
               @if(old('second') === '0')
               <div class="alert alert-danger">Please select a valid option.</div>
               @endif
               <input type="text" name="second_selected" id="second_selected" hidden >
               <input type="text" name="second_selected_name" id="second_selected_name" hidden>
            </div>
            <a href="https://designmykitchen.cloud/specbook"> <button  class="btn btn-warning mt-4 text-uppercase px-5">Back</button></a>
         </div>
         <div class="row g-3 align-items-center">
            <div class="col-md-6">
               <div class="items-image" id="imageContainer1">
                  @php $image_nm = DB::table('product_image')
                  ->leftjoin('product_master','product_master.product_id', '=', 'product_image.product_id')
                  ->leftjoin('draft_product','draft_product.product_id', '=', 'product_master.product_id')
                  ->where('draft_product.product_id',$comparisonData['product1']->product_id)
                  ->select('image_name')
                  ->first(); @endphp 
                  @if($image_nm===null)
                  <img src="" id="getimg"  class="image" style="width: 140px; height: 161px;">
                  @else
                  <img src="/public/img/product/{{$image_nm->image_name}}" id="getimg"  class="image"  style="width: 140px; height: 161px;">
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Category</label>
                  @php $category1 = DB::table('product_category')
                  ->leftjoin('product_master','product_master.product_category_id', '=', 'product_category.category_id')
                  ->where('product_master.product_id',$comparisonData['product1']->product_id)
                  ->select('title')
                  ->first(); @endphp 
                  @if($category1===null)
                  <input type="text" class="form-control" name="Category_name1" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$category1->title}}" name="Category_name1" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Hinge Side</label>
                  @if(isset($comparisonData['product1']['hinge_side']) && $comparisonData['product1']['hinge_side'] === null)
                  <input type="text" class="form-control" name="hige_side1" readonly >
                  @else
                  <input type="text" class="form-control" name="hige_side1" value="{{$comparisonData['product1']->hinge_side}}" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Finish Side</label>
                  @if(isset($comparisonData['product1']['finish_side']) && $comparisonData['product1']['finish_side'] === null)
                  <input type="text" class="form-control" name="finish_side1" readonly >
                  @else
                  <input type="text" class="form-control" name="finish_side1" value="{{$comparisonData['product1']->finish_side}}" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Length</label>
                  @php $Length1 = DB::table('item_dimensions')
                  ->leftjoin('product_master','product_master.product_id', '=', 'item_dimensions.product_id')
                  ->leftjoin('draft_product','product_master.product_id', '=', 'draft_product.product_id')
                  ->where('draft_product.modification_id',$comparisonData['product1']->modification_id)
                  ->select('item_length','item_breadth','item_height')
                  ->first(); @endphp 
                  @if($Length1->item_length===null)
                  <input type="text" class="form-control"  name="Length1" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$Length1->item_length}}" name="length1" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Depth</label>
                  @if($Length1->item_breadth===null)
                  <input type="text" class="form-control"  name="breadth1"  valu="0" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$Length1->item_breadth}}" name="breadth1" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Height</label>
                  @if($Length1->item_height===null)
                  <input type="text" class="form-control"  name="breadth1"  valu="0" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$Length1->item_height}}" name="breadth1" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Modification</label>
                  @php $modification1 = DB::table('modificationmaster')
                  ->leftjoin('draft_product','modificationmaster.modification_id', '=', 'draft_product.modification_id')
                  ->where('draft_product.modification_id',$comparisonData['product1']->modification_id)
                  ->select('modification_nm')
                  ->first(); @endphp 
                  @if($modification1===null)
                  <input type="text" class="form-control"  name="modification1" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$modification1->modification_nm}}" name="modification1" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Accessories</label>
                  @php $accessories1 = DB::table('accessoriesmaster')
                  ->leftjoin('draft_product','accessoriesmaster.accessories_id', '=', 'draft_product.accessories_id')
                  ->where('draft_product.accessories_id',$comparisonData['product1']->accessories_id)
                  ->select('accessories_nm')
                  ->first(); @endphp 
                  @if($accessories1===null)
                  <input type="text" class="form-control"  name="accessories1" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$accessories1->accessories_nm}}" name="accessories1" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Price</label>
                  @if(isset($comparisonData['product1']['total_price']) && $comparisonData['product1']['total_price'] === null)
                  <input type="text" class="form-control" name="price1" readonly >
                  @else
                  <input type="text" class="form-control" name="price1" value="{{$comparisonData['product1']->total_price}}" readonly >
                  @endif
               </div>
            </div>
            <div class="col-md-6">
               <div class="items-image" id="imageContainer2">
                  @php $image_nm2 = DB::table('product_image')
                  ->leftjoin('product_master','product_master.product_id', '=', 'product_image.product_id')
                  ->leftjoin('draft_product','draft_product.product_id', '=', 'product_master.product_id')
                  ->where('draft_product.product_id',$comparisonData['product2']->product_id)
                  ->select('image_name')
                  ->first(); @endphp 
                  @if($image_nm2===null)
                  <img src="" id="getimg"  class="image" style="width: 140px; height: 161px;">
                  @else
                  <img src="/public/img/product/{{$image_nm2->image_name}}" id="getimg"  class="image"  style="width: 140px; height: 161px;">
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Category</label>
                  @php $category2 = DB::table('product_category')
                  ->leftjoin('product_master','product_master.product_category_id', '=', 'product_category.category_id')
                  ->where('product_master.product_id',$comparisonData['product2']->product_id)
                  ->select('title')
                  ->first(); @endphp 
                  @if($category2===null)
                  <input type="text" class="form-control" name="Category_name2" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$category2->title}}" name="Category_name1" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Hinge Side</label>
                  @if(isset($comparisonData['product2']['hinge_side']) && $comparisonData['product2']['hinge_side'] === null)
                  <input type="text" class="form-control" name="hige_side2" readonly >
                  @else
                  <input type="text" class="form-control" name="hige_side2" value="{{$comparisonData['product2']->hinge_side}}" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Finish Side</label>
                  @if(isset($comparisonData['product2']['finish_side']) && $comparisonData['product2']['finish_side'] === null)
                  <input type="text" class="form-control" name="finish_side2" readonly >
                  @else
                  <input type="text" class="form-control" name="finish_side2" value="{{$comparisonData['product2']->finish_side}}" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Length</label>
                  @php $Length2 = DB::table('item_dimensions')
                  ->leftjoin('product_master','product_master.product_id', '=', 'item_dimensions.product_id')
                  ->leftjoin('draft_product','product_master.product_id', '=', 'draft_product.product_id')
                  ->where('draft_product.modification_id',$comparisonData['product2']->modification_id)
                  ->select('item_length','item_breadth','item_height')
                  ->first(); @endphp 
                  @if($Length2->item_length===null)
                  <input type="text" class="form-control"  name="Length2" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$Length2->item_length}}" name="length2" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Depth</label>
                  @if($Length2->item_breadth===null)
                  <input type="text" class="form-control"  name="breadth1"  valu="0" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$Length2->item_breadth}}" name="breadth2" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Height</label>
                  @if($Length2->item_height===null)
                  <input type="text" class="form-control"  name="height2"  valu="0" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$Length2->item_height}}" name="height" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Modification</label>
                  @php $modification2 = DB::table('modificationmaster')
                  ->leftjoin('draft_product','modificationmaster.modification_id', '=', 'draft_product.modification_id')
                  ->where('draft_product.modification_id',$comparisonData['product2']->modification_id)
                  ->select('modification_nm')
                  ->first(); @endphp 
                  @if($modification2===null)
                  <input type="text" class="form-control"  name="modification2" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$modification2->modification_nm}}" name="modification2" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Accessories</label>
                  @php $accessories2 = DB::table('accessoriesmaster')
                  ->leftjoin('draft_product','accessoriesmaster.accessories_id', '=', 'draft_product.accessories_id')
                  ->where('draft_product.accessories_id',$comparisonData['product2']->accessories_id)
                  ->select('accessories_nm')
                  ->first(); @endphp 
                  @if($accessories2===null)
                  <input type="text" class="form-control"  name="accessories2" readonly >
                  @else
                  <input type="text" class="form-control" value="{{$accessories2->accessories_nm}}" name="accessories2" readonly >
                  @endif
               </div>
               <div class="col-md-6" style="margin-top:20px">
                  <label class="form-label">Price</label>
                  @if(isset($comparisonData['product2']['total_price']) && $comparisonData['product2']['total_price'] === null)
                  <input type="text" class="form-control" name="price2" readonly  >
                  @else
                  <input type="text" class="form-control" name="price2" value="{{$comparisonData['product2']->total_price}}" readonly >
                  @endif
               </div>
            </div>
            @endif
         </div>
      </div>
   </div>
   <!-- Row End -->
</div>
@endsection
@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush
@push('custom_styles')
<style>
   .category-column {
   float: left;
   width: 50%;
   }
   .product-info-column {
   float: left;
   width: 50%;
   }
   .category-scroll {
   max-height: 300px;
   overflow-y: auto;
   }
   .hidden-categories {
   display: none;
   }
   /* Basic styles for the plus button */
   .plus-button {
   width: 40px;
   height: 40px;
   background-color: #007bff;
   /* Replace with your desired background color */
   color: #fff;
   /* Replace with your desired text color */
   border: none;
   font-size: 24px;
   font-weight: bold;
   border-radius: 50%;
   /* This makes the button circular */
   cursor: pointer;
   outline: none;
   /* Remove the default focus outline */
   }
   .ct_cls
   {
   margin-bottom: -24px;
   }
   /* On hover, you can add some effects to make it more interactive */
   .plus-button:hover {
   background-color: #0056b3;
   /* Replace with your desired hover background color */
   /* Add other styles for hover effect if needed */
   }
   .bg-lightblue
    {
        background-color:#D9D9D9 !important;
    }
    .re_cls
    {
        padding: 2rem !important;
        margin-bottom: 3rem !important;
    }
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/jQuery.tagify.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
@push('custom_scripts')
<script>
   const categoryScroll = document.querySelector(".category-scroll");
   
   // Show hidden categories when scrolling
   categoryScroll.addEventListener("scroll", function() {
     const hiddenCategories = document.querySelectorAll(".hidden-categories");
     hiddenCategories.forEach(category => {
       if (category.offsetTop <= categoryScroll.scrollTop + categoryScroll.clientHeight) {
         category.classList.remove("hidden-categories");
       }
     });
   });
</script>
<script>
   $(document).ready(function () {
       $('#first_selected_dropdown').on('change', function () {
           var selectedProductId = $(this).val();
           $('#first_selected').val(selectedProductId);
       });
   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
       var productDropdown = document.getElementById('first_selected_dropdown');
       var selectedNameTextbox = document.getElementById('first_selected_name');
   
       productDropdown.addEventListener('change', function () {
           var selectedOption = productDropdown.options[productDropdown.selectedIndex];
           var selectedName = selectedOption.textContent;
           selectedNameTextbox.value = selectedName;
       });
   });
</script>
<script>
   $(document).ready(function () {
       $('#second_selected_dropdown').on('change', function () {
           var selectedProductId = $(this).val();
           $('#second_selected').val(selectedProductId);
       });
   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
       var productDropdown = document.getElementById('second_selected_dropdown');
       var selectedNameTextbox = document.getElementById('second_selected_name');
   
       productDropdown.addEventListener('change', function () {
           var selectedOption = productDropdown.options[productDropdown.selectedIndex];
           var selectedName = selectedOption.textContent;
           selectedNameTextbox.value = selectedName;
       });
   });
</script>
@endpush
@push('custom_scripts')
<script>
   $('#draft1, #draft2').on('change', function() {
       const product1Id = $('#draft1').val();
       const product2Id = $('#draft2').val();
   
       axios.post('/compare/data', {
           draft1: first_draft,
           draft2: second_draft,
       }).then(response => {
           $('#productDataContainer1').html(JSON.stringify(response.data.draft1));
           $('#productDataContainer2').html(JSON.stringify(response.data.draft2));
       });
   });
</script>
<script type="text/javascript">
  
    // Attach an event listener to category radio buttons
    $('input[name="product_category"]').on('change', function() {

        const categoryId = $(this).val();
        loadProducts(categoryId);
    });

    // Function to load products for a specific category
    function loadProducts(categoryId) {
        $.ajax({
            url: '/get-category-products', // Replace with your route to fetch products
            method: 'GET',
            data: { category_id: categoryId },
            success: function(response) {
                $('#get_cat_products').html(response);
            }
        });
    }

</script>
<script type="text/javascript">
   function generatePDF() {
    // Get the HTML content of the invoice
    const invoice = document.getElementById("invoice").innerHTML;
   
    html2pdf().set({
      margin: 0,
      filename: 'Sales Order.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { dpi: 300, letterRendering: true, scale: 2 }, // Adjust the scale value
      jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    }).from(invoice).save();
   }
   html2pdf().set({
  margin: {
    left: 0,
    right: 0,
    top: 10,
    bottom: 10
  },
  filename: 'Sales Order.pdf',
  image: { type: 'jpeg', quality: 0.98 },
  html2canvas: { dpi: 300, letterRendering: true, scale: 2 }, // Adjust the scale value
  jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
}).from(invoice).save();
</script>
@endpush