@extends(backendView('layouts.app'))
@section('title', 'Door Style')
<style>
   .col_lg_4{
      flex: 0 0 auto;
        width: 20%
   }
   </style>
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0">New Drafts</h3>
         </div>
      </div>
   </div>
   <!-- Row end  -->
   <div class="row clearfix g-3">
      <div class="col-lg-12">
         <div class="card mb-3">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
               <h6 class="m-0 fw-bold">Select Style</h6>
            </div>
            <div class="card-body">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="product-details">
                           <div class="row">
                            
                            
                              <div class="product-details-content mt-45">
                                 <div class="product-items">
                                    <!-- <h6 class="item-title fw-bold">Select Your Oculus</h6> -->
                                    <p style="margin-top:20px; margin-left:30px; border-left: 4px solid black; padding-left: 5px;"><b>Framed</b></p>
                                    <div class="items-wrapper" id="select-item-1">
                                       
                                       @php 
                                       $i=1;
                                       @endphp
                                       @foreach($framed_door_style as $index => $val)
                                       <div class="col_lg_4  pd_cls selected_div" id="imageContainer_{{$i}}" >
                                          <div class="single-item">
                                             <div class="items-image" id="imageContainer">
                                             <img src="{{ asset('img/door_style/' . $val['image']) }}" id="getimg" class="imgage" alt="product" style="width: 140px; height: 161px;">

                                                <input id="input_{{$i}}" name="image" value="{{$val['doorStyle_id']}}" hidden>
                                             </div>
                                             <p class="text dc_cls">{{$val->name}}<br>
                                             {{$val->description}}</p>
                                          </div>
                                       </div>
                                       @if(($index + 1) % 5 === 0 || $loop->last)
                                    </div>
                                    <div class="items-wrapper" id="select-item-1">
                                       @endif
                                       @php
                                       $i++;
                                       @endphp
                                       @endforeach
                                    </div>
                                    <p style="margin-top:20px; margin-left:30px; border-left: 4px solid black; padding-left: 5px;"><b>Frameless</b></p>
                                    <div class="items-wrapper" id="select-item-1">
                                       
                                       
                                       @foreach($frameless_door_style as $index => $val)
                                       <div class="col_lg_4  pd_cls selected_div" id="imageContainer_{{$i}}" >
                                          <div class="single-item">
                                             <div class="items-image" id="imageContainer">
                                             <img src="{{ asset('img/door_style/' . $val['image']) }}" id="getimg" class="imgage" alt="product" style="width: 140px; height: 161px;">

                                                <input id="input_{{$i}}" name="image" value="{{$val['doorStyle_id']}}" hidden>
                                             </div>
                                             <p class="text dc_cls">{{$val->name}}<br>
                                             {{$val->description}}</p>
                                          </div>
                                       </div>
                                       @if(($index + 1) % 5 === 0 || $loop->last)
                                    </div>
                                    <div class="items-wrapper" id="select-item-1">
                                       @endif
                                       @php
                                       $i++;
                                       @endphp
                                       @endforeach
                                    </div>
                                 </div>
                              </div>
                           
                           </div>
                           <div class="mt-4">
                              <form action="{{url('add-draft')}}"  method="Post">
                                 @csrf
                                 <input id="doorStyle_id" name="doorStyle_id" hidden >
                                 <input id="draft_id" name="draft_id" value="{{$id}}" hidden>
                                 <table>
                                    <tbody>
                                       <tr><span id="image_error" class="text-danger"></tr>
                                       <tr><button  type="submit"  class="btn btn-warning mt-4 text-uppercase px-5 nx_cls">Next</button></tr>
                                    </tbody>
                                 </table>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Row End -->
</div>
@endsection
@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush
@push('custom_styles')
<style>
   /* White buttons with black border */
   .btn-white-border {
   background-color: white;
   border-top: 1px solid gray;
   border-bottom: 1px solid black;
   color: black;
   }
   .btn-light:focus
   {
   background-color: #eca72f!important;
   }
   .dc_cls
   {
   font-weight: 600!important;
   }
   .product-details .product-details-content .product-items .items-wrapper .single-item
   {
   max-width: none;
   }
   .nx_cls
   {
   
   margin-left: 85px;
   }
   .pd_cls
   {
   padding-bottom: 20px;
   }
</style>
@endpush
@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/index.js') !!}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
@endpush
@push('custom_scripts')
<script>
   $('.selected_div').click(function(){
     const id = $(this).attr('id');
     const parts = id.split('_');
     const number = parts[1];
    console.log($('#input_'+number).val());
    $('#doorStyle_id').val($('#input_'+number).val());
     console.log(number);
   
   })
   function validateForm() {
             var isValid = true;
             var doorStyle_id = $('#doorStyle_id');
   
             if (doorStyle_id.val() == '')
              {
                 isValid = false;
                 $('#image_error').html("Please Select Style ");
                 
              }
              else
              {
                 $('#next_btn').show();
                  
              }
              
             return isValid;
         }
   $('form').on('submit', validateForm);
</script>
<script>
   $('#myDataTable')
    .addClass('nowrap')
    .dataTable({
      responsive: true,
      columnDefs: [{
        targets: [-1, -3],
        className: 'dt-body-right'
      }]
    });
   
</script>
<script>
   // jQuery code to handle the click event and add/remove the "active" class
   $(document).ready(function () {
     // Get all the items with class "single-item"
     const items = $(".single-item");
   
     // Add click event handler to each item
     items.on("click", function () {
       // Remove "active" class from all items
       items.removeClass("active");
   
       // Add "active" class to the clicked item
       $(this).addClass("active");
     });
   });
</script>
<script type="text/javascript" src="{{asset('public/validation/CustomerDraftValidation.js')}}"></script> 
@endpush