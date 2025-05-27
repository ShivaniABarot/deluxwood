


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
                  <p style="font-size: 16px; margin: 6px 0 6px 0;">
    <span style="font-weight: bold; display: inline-block; min-width: 146px;">
        Dear {{$customer_name}},
    </span>
</p>
                  <p style="font-size:14px;margin:25px 0 6px 0;"><span style="display:inline-block;min-width:146px">I hope this message finds you in good health.

</span></p>
                  <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">I'm writing to provide you with an update on your order with Deluxewood Cabinetry. Our team is dedicated to ensuring your experience is seamless and informed.
                     </span>
                  </p>
                  <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">Here are the details:
                     </span>
                  </p>
                  <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">Order Number: #{{$order_number}}<br>Order Date: {{date('d, M Y',strtotime($order_date))}}<br>Current Status: <b>{{$new_status}}</b>
                     </span>
                  </p>
                   <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">Please don't hesitate to reach out if you have any questions or need further information.

                     </span>
                  </p>
                       <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">Thank you for choosing Deluxewood Cabinetry. We look forward to serving you further.
                     </span>
                  </p>
                    <p style="font-size:14px;margin:24 0 6px 0;"><span style="display:inline-block;min-width:146px">Best regards,<br>The Deluxewood Team
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