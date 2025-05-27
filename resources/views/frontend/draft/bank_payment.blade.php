@extends(backendView('layouts.app'))
@section('title', 'Door Style')
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0">Payment</h3>
         </div>
      </div>
   </div>
   <!-- Row end  -->
 
   <div class="bank-payment-container">
   <div class="product-section">
            <h1 class="section-title">Your Order</h1>
            <ul class="product-list">
                <li class="product-item">
                    <div class="product-info">
                        <span class="product-name">Product 1</span>
                        <span class="product-quantity">Quantity: 2</span>
                    </div>
                    <span class="product-price">$20</span>
                </li>
                <li class="product-item">
                    <div class="product-info">
                        <span class="product-name">Product 2</span>
                        <span class="product-quantity">Quantity: 1</span>
                    </div>
                    <span class="product-price">$15</span>
                </li>
                <!-- Add more product items as needed -->
            </ul>
            <div class="total-amount">
                <h3 class="total-title">Total Amount:</h3>
                <span class="amount">$35</span>
            </div>
        </div>
        <div class="bank-details-section">
            <h1 class="section-title">Pay with Bank Transferr</h1>
            <form id="bank-details-form">
                <div class="input-group">
                    <label for="account_number">Account Number</label>
                    <input type="text" id="account_number" name="account_number" class="styled-input" required>
                </div>
                <div class="input-group">
                    <label for="routing_number">Routing Number</label>
                    <input type="text" id="routing_number" name="routing_number" class="styled-input" required>
                </div>
                <!-- Add more bank details fields as needed -->
                <button id="submit-bank-payment" class="payment-button">Complete Payment</button>
            </form>
        </div>
   </div>
   
   <!-- Row End -->
</div>
@endsection
@push('styles')
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f9fc;
}
.bank-payment-container {
    /* max-width: 1200px; */
    margin: 0 auto;
    padding-top: 40px;
    display: flex;
    justify-content: space-between;
}
.product-section, .bank-details-section {
    width: 50%;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.section-title {
    font-size: 20px;
    margin-bottom: 20px;
    color: #333;
}

.product-list {
    list-style: none;
    padding: 0;
    margin-bottom: 30px;
}

.product-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #e1e5eb;
    transition: background-color 0.3s;
}

.product-item:hover {
    background-color: #f7f9fc;
}

.product-info {
    flex: 2;
    display: flex;
    flex-direction: column;
}

.product-name {
    font-size: 18px;
    margin-bottom: 5px;
    color: #333;
}

.product-quantity {
    font-size: 14px;
    color: #777;
}

.product-price {
    flex: 1;
    text-align: right;
    font-size: 18px;
    color: #333;
}

.total-amount {
    margin-top: 20px;
    text-align: right;
}

.total-title {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
}

.amount {
    font-size: 28px;
    color: #007bff;
}

.input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 15px;
            margin-bottom: 10px;
            color: #555;
        }

        .styled-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e1e5eb;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            transition: border-color 0.3s;
            box-sizing: border-box; /* Ensure padding is included in width */
        }
.styled-input:focus {
    border-color: #007bff;
    outline: none;
}

.payment-button {
    padding: 18px 30px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s;
}

.payment-button:hover {
    background-color: #0056b3;
}
</style>
@endpush
@push('custom_styles')
<style>
   
</style>
@endpush
@push('scripts')

@endpush
@push('custom_scripts')

<script type="text/javascript" src="{{asset('public/validation/CustomerDraftValidation.js')}}"></script> 
@endpush