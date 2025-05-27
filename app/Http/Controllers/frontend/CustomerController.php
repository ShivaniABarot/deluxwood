<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Customer;
use App\Models\StateMaster;
use App\Models\AddDraft;
use App\Models\DoorStyle;
use App\Models\EmailAuditLog;
use App\Models\User;
use App\Models\CustomerDraft;
use App\Models\EmailVerifications;
use App\Models\CustomerDraftStyle;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerForm;
use App\Http\Requests\ContactForm;
use App\Http\Requests\CompleteProfileForm;
use Illuminate\Support\Facades\Mail;
use Hash;
use DB;
use Illuminate\Mail\Message;
use Swift_Message;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function complete_profile_create($id)
    {

        $pagename = 'Create Customer';
        $state = StateMaster::pluck('state_name')->toArray();

        // dd($stateNames);
        return view('frontend.customer.complete_profile', compact('pagename', 'state', 'id'));
    }
    public function complete_profile_store(CompleteProfileForm $request, $id)
    {
        if ($request->ajax()) {
            return true;
        }
        // $user_id = Auth::user()->id;

        // $user = new User();  

        // $user->name = $request->company_name;
        // $user->role_id = 2;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);

        // $user->save();
        $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        while (Customer::where('dealer_number', $randomNumber)->exists()) {
            $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        }

        $customer = new Customer();
        $customer->user_id = $id;
        $customer->dealer_number = $randomNumber;
        $customer->company_name = $request->company_name;
        $customer->address = $request->address;
        $customer->representative_name = $request->representative_name;
        // $customer->showroom = $request->showroom;
        $customer->contact_number = $request->contact_number;
        // $customer->domenstic_lines = $request->domenstic_lines;
        $customer->email = $request->email;
        // $customer->import_lines = $request->import_lines;
        $customer->fax = $request->fax;
        // $customer->date_business_started = $request->date_business_started;
        // $customer->showroom_sq = $request->showroom_sq;
        // $customer->annual_cabinet_sales = $request->annual_cabinet_sales;
        $customer->city = $request->city;
        $customer->state = $request->state;
        if ($request->hasfile('company_logo')) {
            $file = $request->file('company_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = rand() . '.' . $extension;

            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                return back()->withErrors(['company_logo' => 'Only JPG and PNG files are allowed.']);
            }
            // if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
            //     return redirect()->route('customer-create')
            //         ->withInput($request->except('company_logo'))
            //         ->withErrors(['company_logo' => 'Only JPG and PNG files are allowed.']);
            // }

            $file->move('public/img/companyLogo', $filename);
            $customer->company_logo = $filename;

        }

        $customer->owner_name = $request->owner_name;
        // $customer->owner_address = $request->owner_address;
        $customer->owner_phone = $request->owner_phone;
        // $customer->owner_city = $request->owner_city;
        // $customer->owner_state = $request->owner_state;
        // $customer->owner_zip = $request->owner_zip;
        $customer->owner_email = $request->owner_email;

        $customer->reference_com_name = $request->reference_com_name;
        $customer->reference_address = $request->reference_address;
        $customer->reference_contact_number = $request->reference_contact_number;
        $customer->reference_city = $request->reference_city;
        $customer->reference_state = $request->reference_state;
        $customer->reference_zip = $request->reference_zip;
        $customer->reference_email = $request->reference_email;
        $customer->account_type = $request->account_type;

        $customer->tex_exempt = $request->tex_exempt;
        if ($request->tex_exempt == "Yes") {
            $customer->tex_id = $request->tex_id;
            if ($request->hasfile('tex_exempt_form')) {
                $file = $request->file('tex_exempt_form');
                $extension = $file->getClientOriginalExtension();
                $filename1 = rand() . '.' . $extension;
                $file->move('public/img/texExemptForm', $filename1);
                $customer->tex_exempt_form = $filename1;

            }
        }
        $customer->created_by = $id;
        // Auth::login($user);


        $data_array = [
            'email' => $request->email,
            'company_name' => $request->company_name,
            'customer_name' => $request->representative_name,
        ];
        try {
            Mail::send('email.register', $data_array, function ($message) use ($data_array) {
                $message->from('info@deluxewoodcabinetry.com', 'Deluxewood Cabinetry')
                    ->to($data_array['email'])
                    ->subject('Registration Confirmation and Status Update');

            });
            $EmailLog = new EmailAuditLog();
            $EmailLog->from = 'info@deluxewoodcabinetry.com';
            $EmailLog->to = $data_array['email'];
            $EmailLog->subject = 'Registration Confirmation and Status Update';
            $EmailLog->user_id = NULL;
            $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
            $EmailLog->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        if ($customer->save()) {
            Auth::logout();
            return redirect('/')->with('success', 'Your Account has been created successfully. Please wait for admin approval ');
        }

    }

    public function create()
    {
        $pagename = 'Create Customer';
        $state = StateMaster::pluck('state_name')->toArray();
        // dd($stateNames);
        return view('frontend.customer.create', compact('pagename', 'state'));
    }

    public function store(CustomerForm $request)
{
    // Handle AJAX requests
    if ($request->ajax()) {
        return true;
    }

    // Create new user
    $user = new User();
    $user->name = $request->company_name;
    $user->role_id = 2;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    // Generate unique dealer number
    $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
    while (Customer::where('dealer_number', $randomNumber)->exists()) {
        $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
    }

    // Create new customer
    $customer = new Customer();
    $customer->user_id = $user->id;
    $customer->dealer_number = $randomNumber;
    $customer->company_name = $request->company_name;
    $customer->address = $request->address;
    $customer->representative_name = $request->representative_name;
    $customer->contact_number = $request->contact_number;
    $customer->email = $request->email;
    $customer->city = $request->city;
    $customer->state = $request->state;

    // Handle company logo upload
    if ($request->hasFile('company_logo')) {
        $file = $request->file('company_logo');
        $extension = $file->getClientOriginalExtension();
        $filename = rand() . '.' . $extension;

        if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
            return back()->withErrors(['company_logo' => 'Only JPG and PNG files are allowed.']);
        }

        $file->move('public/img/companyLogo', $filename);
        $customer->company_logo = $filename;
    }

    // Owner information
    $customer->owner_name = $request->owner_name;
    $customer->owner_phone = $request->owner_phone;
    $customer->owner_email = $request->owner_email;

    // Reference information
    $customer->reference_com_name = $request->reference_com_name;
    $customer->reference_address = $request->reference_address;
    $customer->reference_contact_number = $request->reference_contact_number;
    $customer->reference_city = $request->reference_city;
    $customer->reference_state = $request->reference_state;
    $customer->reference_zip = $request->reference_zip;
    $customer->reference_email = $request->reference_email;
    $customer->account_type = $request->account_type;

    // Tax exempt handling
    $customer->tex_exempt = $request->tex_exempt;
    if ($request->tex_exempt == "Yes") {
        if (!$request->hasFile('tex_exempt_form')) {
            return back()->withErrors(['tex_exempt_form' => 'Tax Exempt Form is required when Tax Exempt is selected.']);
        }
        if (!$request->hasFile('sales_form')) {
            return back()->withErrors(['sales_form' => 'Sales Certificate is required when Tax Exempt is selected.']);
        }

        $customer->tex_id = $request->tex_id;

        // Handle tax exempt form upload
        $file = $request->file('tex_exempt_form');
        $extension = $file->getClientOriginalExtension();
        $filename1 = rand() . '.' . $extension;
        if (!in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png'])) {
            return back()->withErrors(['tex_exempt_form' => 'Only PDF, JPG, and PNG files are allowed for Tax Exempt Form.']);
        }
        $file->move('public/img/texExemptForm', $filename1);
        $customer->tex_exempt_form = $filename1;

        // Handle sales certificate upload
        $file = $request->file('sales_form');
        $extension = $file->getClientOriginalExtension();
        $filename2 = rand() . '.' . $extension;
        if (!in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png'])) {
            return back()->withErrors(['sales_form' => 'Only PDF, JPG, and PNG files are allowed for Sales Certificate.']);
        }
        $file->move('public/img/salesCertificate', $filename2);
        $customer->sales_form = $filename2;
    }

    $customer->created_by = $user->id;

    // Send registration confirmation email
    $data_array = [
        'email' => $request->email,
        'company_name' => $request->company_name,
        'customer_name' => $request->representative_name,
    ];
    try {
        Mail::send('email.register', $data_array, function ($message) use ($data_array) {
            $message->from('info@deluxewoodcabinetry.com', 'Deluxewood Cabinetry')
                ->to($data_array['email'])
                ->subject('Registration Confirmation and Status Update');
        });
        $EmailLog = new EmailAuditLog();
        $EmailLog->from = 'info@deluxewoodcabinetry.com';
        $EmailLog->to = $data_array['email'];
        $EmailLog->subject = 'Registration Confirmation and Status Update';
        $EmailLog->user_id = null;
        $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $EmailLog->save();
    } catch (\Exception $e) {
        return back()->withErrors(['email' => 'Failed to send registration confirmation email: ' . $e->getMessage()]);
    }

    // Send registration alert to admin
    try {
        Mail::send('email.registration_alert', $data_array, function ($message) use ($data_array) {
            $message->from('info@deluxewoodcabinetry.com', 'Deluxewood Cabinetry')
                ->to('info@deluxewoodcabinetry.com')
                ->subject('New User Registration Alert');
        });
        $EmailLog = new EmailAuditLog();
        $EmailLog->from = 'info@deluxewoodcabinetry.com';
        $EmailLog->to = 'info@deluxewoodcabinetry.com';
        $EmailLog->subject = 'New User Registration Alert';
        $EmailLog->user_id = null;
        $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $EmailLog->save();
    } catch (\Exception $e) {
        return back()->withErrors(['email' => 'Failed to send registration alert email: ' . $e->getMessage()]);
    }

    // Save customer and redirect to confirmation page
    if ($customer->save()) {
        return redirect()->route('confirmation');


        // return redirect()->route('confirmation');
    }

    return back()->withErrors(['error' => 'Failed to create account. Please try again.']);
}
    // public function store(CustomerForm $request)
    // {
    //     if ($request->ajax()) {
    //         return true;
    //     }

    //     // dd(12,$request->all());
    //     $user = new User();

    //     $user->name = $request->company_name;
    //     $user->role_id = 2;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);

    //     $user->save();
    //     $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
    //     while (Customer::where('dealer_number', $randomNumber)->exists()) {
    //         $randomNumber = 'D' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
    //     }

    //     $customer = new Customer();
    //     $customer->user_id = $user->id;
    //     $customer->dealer_number = $randomNumber;
    //     $customer->company_name = $request->company_name;
    //     $customer->address = $request->address;
    //     $customer->representative_name = $request->representative_name;
    //     // $customer->showroom = $request->showroom;
    //     $customer->contact_number = $request->contact_number;
    //     // $customer->domenstic_lines = $request->domenstic_lines;
    //     $customer->email = $request->email;
    //     // $customer->import_lines = $request->import_lines;
    //     $customer->fax = $request->fax;
    //     // $customer->date_business_started = $request->date_business_started;
    //     // $customer->showroom_sq = $request->showroom_sq;
    //     // $customer->annual_cabinet_sales = $request->annual_cabinet_sales;
    //     $customer->city = $request->city;
    //     $customer->state = $request->state;
    //     if ($request->hasfile('company_logo')) {
    //         $file = $request->file('company_logo');
    //         $extension = $file->getClientOriginalExtension();
    //         $filename = rand() . '.' . $extension;

    //         if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
    //             return back()->withErrors(['company_logo' => 'Only JPG and PNG files are allowed.']);
    //         }
    //         // if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
    //         //     return redirect()->route('customer-create')
    //         //         ->withInput($request->except('company_logo'))
    //         //         ->withErrors(['company_logo' => 'Only JPG and PNG files are allowed.']);
    //         // }

    //         $file->move('public/img/companyLogo', $filename);
    //         $customer->company_logo = $filename;

    //     }

    //     $customer->owner_name = $request->owner_name;
    //     $customer->owner_address = $request->owner_address;
    //     $customer->owner_phone = $request->owner_phone;
    //     $customer->owner_city = $request->owner_city;
    //     $customer->owner_state = $request->owner_state;
    //     $customer->owner_zip = $request->owner_zip;
    //     $customer->owner_email = $request->owner_email;

    //     $customer->reference_com_name = $request->reference_com_name;
    //     $customer->reference_address = $request->reference_address;
    //     $customer->reference_contact_number = $request->reference_contact_number;
    //     $customer->reference_city = $request->reference_city;
    //     $customer->reference_state = $request->reference_state;
    //     $customer->reference_zip = $request->reference_zip;
    //     $customer->reference_email = $request->reference_email;
    //     $customer->account_type = $request->account_type;

    //     $customer->reference_com_name = $request->reference_com_name;
    //     $customer->reference_address = $request->reference_address;
    //     $customer->reference_contact_number = $request->reference_contact_number;
    //     $customer->reference_city = $request->reference_city;
    //     $customer->reference_state = $request->reference_state;
    //     $customer->reference_zip = $request->reference_zip;
    //     $customer->reference_email = $request->reference_email;
    //     $customer->account_type = $request->account_type;



    //     $customer->tex_exempt = $request->tex_exempt;
    //     if ($request->tex_exempt == "Yes") {
    //         $customer->tex_id = $request->tex_id;
    //         if ($request->hasfile('tex_exempt_form')) {
    //             $file = $request->file('tex_exempt_form');
    //             $extension = $file->getClientOriginalExtension();
    //             $filename1 = rand() . '.' . $extension;
    //             $file->move('public/img/texExemptForm', $filename1);
    //             $customer->tex_exempt_form = $filename1;

    //         }
    //     }

    //     // Handle sales certificate upload
    //     if ($request->hasFile('sales_form')) {
    //         $file = $request->file('sales_form');
    //         $extension = $file->getClientOriginalExtension();
    //         $filename = rand() . '.' . $extension;

    //         // Allow specific file types (e.g., PDF, JPG, PNG)
    //         if (!in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png'])) {
    //             return back()->withErrors(['sales_form' => 'Only PDF, JPG, and PNG files are allowed.']);
    //         }

    //         $file->move('public/img/salesCertificate', $filename);
    //         $customer->sales_form = $filename;
    //     }
    //     $customer->created_by = $user->id;
    //     // Auth::login($user);
    //     // dd(123 , $customer);

    //     $data_array = [
    //         'email' => $request->email,
    //         'company_name' => $request->company_name,
    //         'customer_name' => $request->representative_name,
    //     ];
    //     try {
    //         Mail::send('email.register', $data_array, function ($message) use ($data_array) {
    //             $message->from('info@deluxewoodcabinetry.com', 'Deluxewood Cabinetry')
    //                 ->to($data_array['email'])
    //                 ->subject('Registration Confirmation and Status Update');

    //         });
    //         $EmailLog = new EmailAuditLog();
    //         $EmailLog->from = 'info@deluxewoodcabinetry.com';
    //         $EmailLog->to = $data_array['email'];
    //         $EmailLog->subject = 'Registration Confirmation and Status Update';
    //         $EmailLog->user_id = NULL;
    //         $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    //         $EmailLog->save();
    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //     }
    //     try {
    //         Mail::send('email.registration_alert', $data_array, function ($message) use ($data_array) {
    //             $message->from('info@deluxewoodcabinetry.com', 'Deluxewood Cabinetry')
    //                 ->to('info@deluxewoodcabinetry.com')
    //                 ->subject('New User Registration Alert');

    //         });
    //         $EmailLog = new EmailAuditLog();
    //         $EmailLog->from = 'info@deluxewoodcabinetry.com';
    //         $EmailLog->to = 'info@deluxewoodcabinetry.com';
    //         $EmailLog->subject = 'New User Registration Alert';
    //         $EmailLog->user_id = NULL;
    //         $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    //         $EmailLog->save();
    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //     }

    //     if ($customer->save()) {
    //         return redirect('/')->with('success', 'Your Account has been created successfully. Please wait for admin approval ');
    //     }

    // }

    public function contact()
    {
        $pagename = 'Contact Us';
        return view('frontend.customer.contact', compact('pagename'));
    }

    public function contactStore(ContactForm $request)
    {
        if ($request->ajax()) {
            return true;
        }

        $name = $request->contact_name;
        $email = $request->contact_email;
        $subject = $request->subject;
        $phone = $request->contact_no;
        $msg = $request->message;

        $data_array['name'] = $name;
        $data_array['email'] = $email;
        $data_array['subject'] = $subject;
        $data_array['phone'] = $phone;
        $data_array['msg'] = $msg;

        try {
            Mail::send('email.contact', $data_array, function ($message) use ($data_array) {
                $message->from('info@deluxewoodcabinetry.com', 'Deluxewood Cabinetry')
                    ->to('info@deluxewoodcabinetry.com')
                    ->replyTo($data_array['email'], $data_array['name'])
                    ->subject('Contact Us');
            });
            $EmailLog = new EmailAuditLog();
            $EmailLog->from = $data_array['email'];
            $EmailLog->to = 'info@deluxewoodcabinetry.com';
            $EmailLog->subject = 'Contact Us';
            $EmailLog->user_id = NULL;
            $EmailLog->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
            $EmailLog->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect('/contact-us')->with('success', 'Message Sent Successfully');
    }
    public function about()
    {
        $pagename = 'About Us';

        return view('frontend.customer.about', compact('pagename'));
    }
    public function termCondition()
    {
        $pagename = 'Terms And Conditions';
        return view('frontend.customer.terms_condition', compact('pagename'));
    }
    public function accessDenied()
    {
        $pagename = 'Access Denied';
        return view('frontend.customer.access_denied', compact('pagename'));
    }
    public function draft_product(Request $request, $draft_style_id)
    {
        $pagename = 'Draft Product';
        $draft_style = AddDraft::find($draft_style_id);
        $img = DoorStyle::select('image', 'name')->where('doorStyle_id', $draft_style->door_style_Id)->first();
        $nm = $img->name;
        $img_nm = $img->image;

        $products = DB::table('product_master')
            ->leftJoin('product_door_style', 'product_master.product_id', '=', 'product_door_style.product_id')
            ->leftJoin('product_item', 'product_master.product_id', '=', 'product_item.product_id')
            ->where('product_door_style.door_style_id', $draft_style->door_style_Id)
            ->where('product_item.product_item_sku', 'LIKE', '%' . $request->search . '%')
            ->select('product_master.*', 'product_item.*')
            ->get();

        return view('frontend.draft.add_draft', compact('draft_style', 'nm', 'img_nm', 'products', 'draft_style_id', 'pagename'));
    }

    public function sendOtp($user)
    {
        $otp = rand(100000, 999999);
        $time = time();

        EmailVerifications::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'otp' => $otp,
                'created_at' => $time
            ]
        );

        $data['email'] = $user->email;
        $data['title'] = 'Mail Verification';

        $data['body'] = 'Your OTP is:- ' . $otp;

        Mail::send('auth.mailVerification', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });
    }

    public function otpVerify($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user || $user->is_verified == 1) {
            return redirect('/');
        }
        $email = $user->email;

        $this->sendOtp($user);
        return view('frontend.auth.otp', compact('email'));
    }
    public function loadLogin()
    {
        if (Auth::user()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }
    public function verifiedOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerifications::where('otp', $request->otp)->first();
        if (!$otpData) {
            return response()->json(['success' => false, 'msg' => 'You entered wrong OTP']);
        } else {

            $currentTime = time();
            $time = $otpData->created_at;
            if ($currentTime >= $time->timestamp && $time->timestamp >= $currentTime - (90 + 5)) {
                User::where('id', $user->id)->update(['is_verified' => 1]);
                Auth::login($user);
                User::where('id', $user->id)->update(['is_verified' => null]);
                return response()->json(['success' => true, 'msg' => 'Mail has been verified']);

            } else {
                return response()->json(['success' => false, 'msg' => 'Your OTP has been Expired']);
            }

        }
        // $update_user=User::find($user->id);
        // $update_user->modification_nm = NULL;
        // $update_user->save();


    }
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required'
        ]);

        $userCredential = $request->only('email', 'password');
        $userData = User::where('email', $request->email)->first();
        if ($userData && $userData->is_verified == 0) {
            $this->sendOtp($userData);
            return redirect("/verification/" . $userData->id);
        } else if (Auth::attempt($userCredential)) {
            dd($userCredential);
            return redirect('/dashboard');
        } else {
            return back()->with('error', 'Username & Password is incorrect');
        }
    }
    public function loadDashboard()
    {
        if (Auth::user()) {
            return view('dashboard');
        }
        return redirect('/');
    }


}

