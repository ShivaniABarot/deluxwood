@extends(backendView('layouts.app'))
@section('title', 'Door Style')
@section('content')

<button id="checkout-button">Checkout</button>
@endsection
@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush
@push('custom_styles')

@endpush
@push('scripts')
<!-- Plugin Js -->
<script src="https://js.stripe.com/v3/"></script>
<script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/index.js') !!}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
@endpush
@push('custom_scripts')
<script>
     var stripe = Stripe('pk_test_51Nd74uSCdkaUsfIh6DxalLoKNmOgVE3NRiJU6PLWf5pZfvRDLtRtZURWkzMPaqdWnDI12W1dHeellQtTFBE63x1p00KbGjlWAS'); // Replace with your actual Stripe public key
     var checkoutButton = document.getElementById('checkout-button');

checkoutButton.addEventListener('click', function() {
    // Create a payment method and send token to the server
    stripe.createPaymentMethod({
        type: 'card',
        card: cardElement // Replace with your card element instance
    }).then(function(result) {
        if (result.error) {
            // Handle errors
        } else {
            var paymentMethodToken = result.paymentMethod.id;

            // Send payment method token to the server
            fetch('/create-payment-method', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    payment_method_token: paymentMethodToken
                })
            })
            .then(response => response.json())
            .then(data => {
                // Handle the server response as needed
                console.log(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});
    </script>
@endpush