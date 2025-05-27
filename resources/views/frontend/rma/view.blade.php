@extends(backendView('layouts.app'))
@section('title', "RMA's View")
@section('content')
<div class="container-xxl">
<div class="row align-items-center">
   <div class="border-0 mb-4">
      <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
         <h3 class="fw-bold mb-0">View</h3>
      </div>
   </div>
</div>
<div class="row clearfix g-3">
   <div class="col-lg-12">
      <div class="card mb-3">
         <form action="{{url('replace-order')}}" method="POST">
            @csrf
            <input type="hidden" name="draft_product_id" value="{{$draft_product_id}}">
         <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
            <h6 class="m-0 fw-bold">Select Style</h6>
         </div>
         <div class="card-body">
            <div class="row g-3 align-items-center">
               <div class="col-md-6">
                  <div class="single-item  active">
                     <div class="items-image">      
                        <img src="{{ asset('public/img/door_style/'.$replace_data['image'])}}" alt="product" style="width: 185px; height: 210px;border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.08); border: 1px solid var(--border-color);cursor: pointer;">
                     </div>
                     <div class="col-lg-12">
                        <div class="row">
                           <div class="col-md-6">
                              <p class="text dc_cls">{{$replace_data->name}}</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="row">
                     <div class="col-md-12">
                        <label class="form-label">Status</label>
                     </div>
                     <div class="col-md-12">
                        <input type="text" class="form-control" name="" value="{{$replace_data->draft_status}}" readonly>
                     </div>
                  </div>
               </div>
            </div>
            <div class="table-container tb_cls" style="" id="14-table-container">
               <table id="14-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                  <thead>
                     <tr>
                        <th>QTY.</th>
                        <th>Item</th>
                        <th>Description</th>
                        <th class="text-center">Hinge Side</th>
                        <th class="text-center">Finished End</th>
                        <th class="text-center">Reason</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td style="width:16%;">
                           <div class="input-group">
                              <input type="button" value="-" class="button-minus quantity-minus" data-product-id="12" data-draft-style-id="47" data-field="quantity">
                              <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field quantity-num">
                              <input type="button" value="+" class="button-plus quantity-plus" data-product-id="12" data-draft-style-id="47" data-field="quantity">
                           </div>
                        </td>
                        <td style="width:16%;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$replace_data->product_item_name}}">{{ Str::limit($replace_data->product_item_name, 25) }}</td>
                        <td style="width:13%;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$replace_data->description}}">{{ Str::limit($replace_data->description, 25) }}</td>
                        <td style="width:20%;" class="text-center">
                           <div class="size-block">
                              <div class="collapse show" id="size" style="">
                                 <div class="filter-size" id="filter-size-1">
                                    <ul>
                                       <li class="hinge_li {{ $replace_data->hinge_side === 'L' ? 'active' : '' }}" data-hinge="L" data-product-id="12" data-draft-style-id="47">L</li>
                                       <li class="hinge_li {{ $replace_data->hinge_side === 'R' ? 'active' : '' }}" data-hinge="R" data-product-id="12" data-draft-style-id="47">R</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </td>
                        <td style="width:20%;" class="text-center">
                           <div class="size-block">
                              <div class="collapse show" id="size" style="">
                                 <div class="filter-size" id="filter-size-1">
                                    <ul>
                                       <li class="finish_li {{ $replace_data->finish_side === 'L' ? 'active' : '' }}" data-finish="L" data-product-id="12" data-draft-style-id="47">L</li>
                                       <li class="finish_li {{ $replace_data->finish_side === 'R' ? 'active' : '' }}" data-finish="R" data-product-id="12" data-draft-style-id="47">R</li>
                                       <li class="finish_li {{ $replace_data->finish_side === 'B' ? 'active' : '' }}" data-finish="B" data-product-id="12" data-draft-style-id="47">B</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </td>
                        <td style="width: 20%;"><input type="text" name="reason" class="form-control re_cls"></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="card">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-8">
                     <div class="table-form table-layout-2 table-responsive pt-3">
                        <table class="tablepdf">
                           <thead>
                              <tr>
                                 <th scope="col" style="font-size: 22px;">Price</th>
                                 <!-- <th scope="col" class="text-right">Total</th> -->
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <th scope="row">
                                    <div class="table-content">
                                       <p class="title" style="padding-top: 20px;">Total Net:</p>
                                    </div>
                                 </th>
                                 <td>
                                    <div class="table-content text-right">
                                       <p class="title" style="padding-top: 20px;"><b>$ 528</b>
                                       </h3>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <th scope="row">
                                    <div class="table-content">
                                       <p class="title">Discount</p>
                                    </div>
                                 </th>
                                 <td>
                                    <div class="table-content text-right">
                                       <p class="title pb-2"><b>20%</b>
                                       </h3>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <th scope="row">
                                    <div class="table-content">
                                       <h6><b>Total Cost:</b></h6>
                                    </div>
                                 </th>
                                 <td>
                                    <div class="table-content text-right">
                                       <h6><b>$ 600</b></h6>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <button type="submit" class="btn btn-warning mt-4 text-uppercase px-5 rpl_cls">Replace</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
      </div>
   </div>
   <!-- Row End -->
</div>

@endsection
@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('custom_styles')
<style>
   /* White buttons with black border */
   .toggle-button-container {
   display: flex;
   }
   .toggle-button {
   padding: 8px 16px;
   font-size: 14px;
   cursor: pointer;
   border: 1px solid gray;
   border-radius: 10px; /* Add rounded corners */
   margin-right: 10px; /* Add spacing between buttons */
   }
   .toggle-button.active {
   background-color: gray;
   color: white;
   border: 1px solid gray;
   }
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
   padding-left: 7px;
   padding-top: 15px;
   }
   .nx_cls
   {
   color: #ffc107 !important;
   }
   .nx_cls:hover
   {
   background: none;
   }
   .size-block .filter-size ul li.active
   {
   background-color: #101010;
   border-color: #101010;
   }
   input,
   textarea {
   border: 1px solid #eeeeee;
   box-sizing: border-box;
   margin: 0;
   outline: none;
   padding: 10px;
   }
   input[type="button"] {
   -webkit-appearance: button;
   cursor: pointer;
   }
   input::-webkit-outer-spin-button,
   input::-webkit-inner-spin-button {
   -webkit-appearance: none;
   }
   .input-group {
   clear: both;
   margin: 15px 0;
   position: relative;
   }
   .input-group input[type='button'] {
   background-color: #eeeeee;
   min-width: 31px;
   width: auto;
   transition: all 300ms ease;
   }
   .input-group .button-minus,
   .input-group .button-plus {
   font-weight: bold;
   height: 38px;
   padding: 0;
   width: 38px;
   position: relative;
   }
   .input-group .quantity-field {
   position: relative;
   height: 38px;
   left: -6px;
   text-align: center;
   width: 62px;
   display: inline-block;
   font-size: 13px;
   margin: 0 0 5px;
   resize: vertical;
   }
   .button-plus {
   left: -13px;
   }
   input[type="number"] {
   -moz-appearance: textfield;
   -webkit-appearance: none;
   }
   .custom-modal {
   position: fixed;
   right: 0;
   top: 0;
   width: 300px; /* Adjust width as needed */
   height: 100%;
   background-color: #f5f5f5;
   z-index: 9999;
   overflow: hidden;
   box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
   }
   .custom-modal-content {
   padding: 20px;
   }
   .custom-modal-header {
   display: flex;
   justify-content: space-between;
   align-items: center;
   border-bottom: 1px solid #d9d9d9;
   }
   .custom-modal-header h3 {
   margin: 0;
   }
   .custom-modal-body {
   margin-top: 10px;
   }
   .custom-modal-body ul {
   list-style: none;
   padding: 0;
   margin: 0;
   }
   .custom-modal-body li {
   padding: 8px 0;
   cursor: pointer;
   }
   .custom-modal-body li:hover {
   background-color: #e6e6e6;
   }
   .custom-modal-body li:first-child {
   padding-top: 0;
   }
   .custom-modal-body li:last-child {
   padding-bottom: 0;
   }
   .close {
   font-size: 20px;
   font-weight: bold;
   cursor: pointer;
   }
   .enable-after-saving {
   pointer-events: auto;
   opacity: 1;
   }
   .tb_cls
   {
   padding-top: 35px;
   }
   .re_cls
   {
   border-color: #eca72f;
   }
   .rpl_cls
   {
   float: right;
   }
    .tablepdf tr th {
    color: var(--text-color);
    text-transform: uppercase;
    font-size: 13px;

   }
    .tablepdf tr td
    {
      font-size: 13px;
    }
   .tablepdf > :not(:first-child) {
       border-top: 2px solid currentColor;
   }
   .tablepdf {
       border-color: var(--border-color);
   }
   .tablepdf {
       --bs-table-bg: transparent;
       --bs-table-accent-bg: transparent;
       --bs-table-striped-color: #212529;
       --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
       --bs-table-active-color: #212529;
       --bs-table-active-bg: rgba(0, 0, 0, 0.1);
       --bs-table-hover-color: #212529;
       --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
       width: 100%;
       margin-bottom: 1rem;
       color: #212529;
       vertical-align: top;
       
   }
   .tablepdf > :not(caption) > * > * {
       padding: 0px!important;
   }
</style>
@endpush
@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/index.js') !!}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<!--autocomplete search-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endpush
@push('custom_scripts')
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
   
   
   function incrementValue(e) {
   e.preventDefault();
   var fieldName = $(e.target).data('field');
   var parent = $(e.target).closest('div');
   var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
   
   if (!isNaN(currentVal)) {
    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
   } else {
    parent.find('input[name=' + fieldName + ']').val(0);
   }
   }
   
   function decrementValue(e) {
   e.preventDefault();
   var fieldName = $(e.target).data('field');
   var parent = $(e.target).closest('div');
   var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
   
   if (!isNaN(currentVal) && currentVal > 0) {
    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
   } else {
    parent.find('input[name=' + fieldName + ']').val(0);
   }
   }
   
   $('.input-group').on('click', '.button-plus', function(e) {
   incrementValue(e);
   });
   
   $('.input-group').on('click', '.button-minus', function(e) {
   decrementValue(e);
   });
   
</script>
@endpush