


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
                     Dear {{$customer_name}},</span>
                  </p>
                  <p style="font-size:14px;margin:25px 0 6px 0;"><span style="display:inline-block;min-width:146px">I trust this email finds you well. I wanted to personally update you on the status of your recent request for item replacement. I'm pleased to inform you that your request has been thoroughly reviewed and approved.</span></p>
                  <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">We understand the importance of having a functioning product and are committed to ensuring your satisfaction. Your replacement item will be processed and shipped to your provided address shortly. You can expect to receive it within <b>{{$estimated_time}}</b>.
                     </span>
                  </p>
                    <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">Thank you for your patience throughout this process. If you have any further questions or concerns, please feel free to reach out to our customer support team.
                     </span>
                  </p>
                       <p style="font-size:14px;margin:20 0 6px 0;"><span style="display:inline-block;min-width:146px">We appreciate your business and look forward to continuing to serve you.
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