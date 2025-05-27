<html>
   <body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
      <table style="max-width:670px;margin:50px auto 10px;background-color:#fbfaf6;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);">
         <thead>
            <tr>
               <th style="text-align:center;"> <img src="{{asset('public/logo.png')}}" class="img" alt="logo" style="width: 37%; padding-bottom: 18px;" 
                  />
               </th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px; background: white;">
                  <p style="font-size:16px;margin:6 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">
                     Dear Admin,</span>
                  </p>
                  <p style="font-size:14px;margin:25px 0 6px 0;"><span style="display:inline-block;min-width:146px">We hope this message finds you well. We are writing to inform you that a new order has been placed on our DeluxeWood Cabinetry online platform.</span></p>
                  <p style="font-size:14px;margin:20 0 6px 0;"><b><span style="display:inline-block;min-width:146px">Order Details:
                     </span></b>
                  </p>
                  <span style="font-size:14px;">
                    Order Number: #{{$custEmail->customer_draft_id}}<br>
                    Date: {{$custEmail->created_at->format('d-m-Y') }}<br>
                    Client: {{$custEmail->client_name}}<br>
                    Email: {{$custEmail->client_email}}<br>

                    Product(s):
                     @if ($products->isNotEmpty())
                         @php
                             $productNames = $products->pluck('product_name')->implode(', ');
                             $productNames = ltrim($productNames, ', ');
                         @endphp
                         {{ $productNames }}
                     @endif
                    <br>
                    Total Amount: {{$custEmail->total_price}}
                    <br>
                    Payment Method: {{$custEmail->payment_method}}
                  </span>
                  <p style="font-size:14px;margin:20 0 6px 0;"><b><span style="display:inline-block;min-width:146px">Shipping Information:
                     </span></b>
                  </p>
                  <span style="font-size:14px;">
                    Shipping Address: {{ $custEmail->ship_address }},
                    {{ $custEmail->ship_city }},
                    {{ $custEmail->state_name }},
                    {{ $custEmail->ship_zip_code }}<br><br>
                    This order is currently in the processing stage, and we kindly ask you to ensure that all necessary steps are taken to fulfill the client's request promptly.
                    </span>
                  <p style="font-size:14px;margin:20 0 6px 0;"><b><span style="display:inline-block;min-width:146px">Action Required:
                     </span></b>
                  </p>
                  <span style="font-size:14px;">
                    Verify payment status and confirm successful transaction.<br>
                    Prepare the order for shipment and provide the tracking information once available.<br>
                    Monitor the shipping process to ensure timely delivery.<br>
                    Should you have any questions or require additional information regarding this order, please do not hesitate to contact our customer service team at <a href="mailto:info@deluxewoodcabinetry.com">info@deluxewoodcabinetry.com</a> or call <a href="tel:+14756552687">(475) 655-2687</a>.
                    </span>
                 
                   <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">Thank you for your attention to this matter. We appreciate your dedication to providing excellent service to our valued clients.
                     </span>
                  </p>
                 
                     <p style="font-size:14px;margin:20 0 0 0;"><span style="display:inline-block;min-width:146px">Best regards,
                      <br>The Deluxewood Team<br>
                     </span>
                  </p>
               </td>
            </tr>
            <tr>
               <td>
                  <p style="font-size:13px;margin:14px 0 0px 60px;"><span style="display:inline-block;min-width:146px">P.S.: This is a system generated email. Please do not reply to this email.</span></p>
               </td>
            </tr>
            <tr>
               <td style="height:20px;"></td>
            </tr>
         </tbody>
      </table>
   </body>
</html>