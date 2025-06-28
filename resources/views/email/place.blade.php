<html>
   <body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
      <table style="max-width:670px;margin:50px auto 10px;background-color:#fbfaf6;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);">
         <thead>
            <tr>
               <th style="text-align:center;"> <img src="https://deluxewoodexpress.com/public/logo.png" class="img" alt="logo" style="width: 37%; padding-bottom: 18px;" 
                  />
               </th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px; background: white;">
                  <p style="font-size:16px;margin:6 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">
                     Dear {{$representative_name}},</span>
                  </p>
                  <p style="font-size:14px;margin:25px 0 6px 0;"><span style="display:inline-block;min-width:146px">Thank you for choosing DeluxeWood Cabinetry for your furniture needs! We are delighted to confirm that your order has been successfully received and processed. Your satisfaction is our priority, and we appreciate the trust you've placed in us.</span></p>
                  <p style="font-size:14px;margin:20 0 6px 0;"><b><span style="display:inline-block;min-width:146px">Order Details:
                     </span></b>
                  </p>
                  <span style="font-size:14px;">
                    Order Number: #{{$customer_draft_id}}<br>
                    @php
                    use Carbon\Carbon;
                    $_stockupdate = Carbon::parse($created_at)->format('m-d-Y'); 
                     @endphp
                    Date: {{$_stockupdate}}<br>
                    Product(s): 
                     @foreach ($products as $key => $data)
                        {{ $data->product_item_sku }}{{ $key != $products->count() - 1 ? ',' : '' }}
                     @endforeach
                    
                    <br>
                    Shipping Cost: {{$shippingCost}}<br>
                     <!-- @if($service_type == "Curbside Delivery")
                        Shipping Cost: $150<br>
                     @endif
                     @if($service_type  == "In-house Delivery")
                        Shipping Cost: $250<br>
                     @endif -->
                    Total Amount: {{$total_price}}
                    <br>
                    Payment Method : {{$payment_method}}
                    <br>
                    Note : {!! $customer_note !!} 
                  </span>
                  <p style="font-size:14px;margin:20 0 6px 0;"><b><span style="display:inline-block;min-width:146px">Shipping Information:
                     </span></b>
                  </p>
                  <span style="font-size:14px;">
                     Shipping Method: {{$service_type}}<br>
                    Shipping Address: {{ $ship_address }},
                    {{ $ship_city }},  
                    {{ $state_name->state_name }},
                    {{ $ship_zip_code }}<br><br>
                   <b> Estimated Delivery Time:</b><br>
                    We are working diligently to prepare your order for shipment. You can expect your DeluxeWood Cabinetry to arrive at your doorstep by <b>7-10 BUSINESS DAYS.</b>
                    </span>
         
                 
                   <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">Thank you for choosing DeluxeWood Cabinetry!<br>We truly value your business and appreciate your confidence in our products. Should you have any questions or require further assistance, please feel free to reach out to our customer service team at <a href="mailto:info@deluxewoodcabinetry.com">info@deluxewoodcabinetry.com</a> or call <a href="tel:+14756552687">(475) 655-2687</a>.
                     </span>
                  </p>
                  <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">An email notification has also been sent to our administration team for record-keeping and processing purposes.
                     </span>
                  </p>
                  <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">We look forward to serving you, and once again, thank you for choosing DeluxeWood Cabinetry!
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