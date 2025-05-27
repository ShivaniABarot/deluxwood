@extends(backendView('layouts.app'))

@section('title', 'Customer Group Add')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<!-- <h3 class="fw-bold mb-0">Payment Add</h3> -->
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				
				<div class="card-body">
                    <div class="row">
                        <div class="col-7">
                       
                        <div class="credit-card-options">
                    @foreach ($credit_card as $credit_card)
                    <label class="credit-card-option" >
                    <div style="display: inline-block;">
                        <input type="radio" name="selected_card" value="{{ $credit_card->customer_credit_card_id }}">
                        <div class="card-preview">
                           
                            <div class="card-details">
                                <div style=" display: inline-block;">
                                <span class="card-type">{{ $credit_card->credit_card_type }}  </span>
                                <span class="card-number">{{ $credit_card->credit_card_number }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </label>
                    @endforeach
                </div>
                        </div>
                        <div class="col-5" style="padding:20px">
                            <a href="#"> Cancel and return to website </a>
                            <table class="col-12"  style="background-color:#e0e0e0; padding: 70px; margin-top:20px;">
                                <tr >
                                    <td><p style="padding-left:20px; padding-top:20px">Total Net:</p> </td>
                                     <td><p   style="margin-left:40px;">${{$customer_draft->original_price}}</p> </td>
                               </tr>
                               <tr >
                                     <td><p style="padding-left:20px">Discount:</p> </td>
                                     <td><p style="margin-left:40px;" >{{$customer_draft->discount}}%</p> </td>
                              </tr>
                                <tr >
                                     <td><p style="padding-left:20px" >Total Cost:</p> </td>
                                     <td><p style="margin-left:40px;">${{$customer_draft->total_price}}</p> </td>
                              </tr>
                            </table>
                        </div>
                    </div>
				
				</div>
			</div>
		</div>
	</div><!-- Row End -->
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
 .credit-card-options {
    max-width: 450px;
    margin: 20px auto;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    
    padding: 20px;
}


.card-preview {
    border: 1px solid #ccc;
    padding: 10px;
    display: flex;
    align-items: center;
}

.card-preview img {
    width: 50px;
    height: auto;
    margin-right: 10px;
}

.card-details {
    display: flex;
    flex-direction: column;
    text-align: left;
}

.card-type {
    font-size: 14px;
    font-weight: bold;
}

.card-number {
    font-size: 12px;
    color: #888;
}

.checkout-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: block;
    margin: 20px auto 0;
}

.checkout-button:hover {
    background-color: #0056b3;
}

</style>
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
<script type="text/javascript" src="{{asset('public/validation/CreditCardValidation.js')}}"></script> 
@endpush

@push('modals')
@endpush