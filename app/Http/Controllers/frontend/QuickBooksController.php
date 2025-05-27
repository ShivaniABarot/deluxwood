<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use GuzzleHttp\Client;
use QuickBooksOnline\API\Data\IPPReferenceType;
use QuickBooks\Logger;
use QuickBooksOnline\API\Facades\Invoice;
use QuickBooksOnline\API\Facades\Payment;
use QuickBooksOnline\API\Facades\Customer;
use App\Http\Controllers\Controller;
use QuickBooksOnline\API\Data\IPPInvoice;
use QuickBooksOnline\API\Data\IPPLine;


class QuickBooksController extends Controller
{
       
    public function createInvoice2(Request $request)
    {
        // Replace with your QuickBooks OAuth2 credentials
        // $clientId = 'AB5TrgVRS8muo28V8LZkKLypDyIeqseVaCiI2nlUVvMQjMU3Gj';
        // $clientSecret = 'XIsIlWrBEe9a8zw5vStgnR7TzjDn7uGQuMAzEvbS';
        // $accessToken = 'eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwiYWxnIjoiZGlyIn0..jrlVMNljWAxpzLUkfRXBUg.NNRSlJRC6sV6YfLT0rM7vxzdhHOooWMFo9jbgThSTXHhdiyVzeP7xvbbPY6Ea-MsSNEH9vS9ipoAu4tmHXQaVDj35D9atkvvsPzzSRU2q5YCdisUbuSqexPkI6exhf5iNjduf1XR6vXiMRccQHW2o18jR2BvEGsRJfaYNvWYWNsb6NsYaHrqnEQM71VjSdb_i_UDaG3O23hEZqOhTGoDQ2KEx4d-TyC5-SsDHYBx4hmwO0OjJeQcztsTm6YwR5iMaV7QyDBpqwwExrYSpfH29YX0Kdjbq2ijkIBhTQ4sHZRkJjgbu1ERa1EGM3Afo7Crq0YH3rXadGnJaa_30k8RpJSE9jQB_vG7MH__u-zRSyW5pulv3lRoeFdMzQIsUmVvi-ZZQONeO3KyUWaF0qanoY2yzS65MXhsUSrlWKqTQqM2GLmvFYTqwfm3N3mtGtst5lSSu0_mf48_Mvyi117TKsxkc8jJ2hvuo2WOumwTpTFiCYMM8d25Pn8eTAb9cBRpqVPsP65ZuBTcciAXORhje16HQX0cyFHKBHq63M5RYafboJ8q0LX1SHAUi7a_H45QCsoyvPVktyEcfA8XXD3bO7sTmiK2hxv8viB10YTOH9RXTEHchcejhKSEOKgblxSKT1Z69fz5C4bNSmueYyfQXkuJ6Q94-0CQDm3MEtuYL4zIhqvvb8aMTq7qwnKWwwym1cwEmOv2-OM3O-I0rX60Y-bVw2mU583Q76jb5BFV_w1BPlE08yldwiAyYJB2fNDq.jzcPpGN_tr4rValf5J7hbA';
        // $companyId = '4620816365341697800'; // QuickBooks company ID
       
        // Define the API endpoint for creating an invoice
        $apiEndpoint = "https://quickbooks.api.intuit.com/v3/company/$companyId/invoice";

        // Define the invoice data (replace with your actual invoice data)
        $invoiceData = [
            'Line' => [
                [
                    // Invoice line items
                ],
            ],
            // Other invoice data
        ];

        // Send the POST request to create the invoice
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post($apiEndpoint, $invoiceData);

        // Check the response and handle errors
        if ($response->successful()) {
            // Invoice created successfully
            $invoiceResponse = $response->json();
            return response()->json(['message' => 'Invoice created successfully', 'data' => $invoiceResponse]);
        } else {
            // Handle error
            $errorResponse = $response->json();
            return response()->json(['error' => $errorResponse], $response->status());
        }
    
    }
    public function showPaymentForm()
    {
        return view('frontend.draft.quickbooks');
    }

    public function initiatePayment(Request $request,$id)
    {
        $user = $request->user();
        $amount = $request->input('amount'); 
       
        // Configure QuickBooks OAuth 2.0 settings
        $config = config('quickbooks');
        $authUrl = $this->buildAuthorizationUrl($config);

        return redirect($authUrl);
    }

   
     public function paymentCallback(Request $request)
    {
        $pagename = "Payment Sucess";
        // Capture the authorization code from the callback URL
        $authorizationCode = $request->input('code');

        // Exchange the authorization code for an access token
        $accessToken = $this->exchangeAuthorizationCodeForToken($authorizationCode);

        // Perform payment processing using QuickBooks API
        $invoiceId = $this->createInvoice($accessToken);
        //  $paymentReceiptId = $this->chargePaymentMethod($accessToken);

        // You can customize the response view and provide feedback to the user
         return view('frontend.draft.success',compact('pagename'));
        // return view('frontend.draft.quickbooks-success', compact('invoiceId', 'paymentReceiptId'));
    }
    // Implement other payment-related actions here

    private function buildAuthorizationUrl($config)
{
    $state = bin2hex(random_bytes(16)); // Generate a random state value
    $query = http_build_query([
        'client_id' => $config['ClientID'],
        'response_type' => 'code',
        'scope' => $config['scope'],
        'redirect_uri' => $config['RedirectURI'],
        'state' => $state, // Include the state parameter
    ]);

    return "https://appcenter.intuit.com/connect/oauth2?" . $query;
}


    private function exchangeAuthorizationCodeForToken($authorizationCode)
    {
        $config = config('quickbooks');

        $client = new Client();
        $response = $client->post('https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $authorizationCode,
                'redirect_uri' => $config['RedirectURI'],
            ],
            'auth' => [
                $config['ClientID'],
                $config['ClientSecret'],
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);
        return $responseBody['access_token'];
    }
    
    private function createInvoice($accessToken)
    {
       

         // Define the API endpoint for creating a customer
    $apiEndpoint = 'https://quickbooks.api.intuit.com/v3/company/4620816365341697800/customer';

    // Define the customer data (replace with your actual customer data)
    $customerData = [
        'DisplayName' => 'Customer Name',
        'PrimaryEmailAddr' => [
            'Address' => 'customer@example.com',
        ],
        // Other customer data fields
    ];

    // Send the POST request to create the customer
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json',
    ])->post($apiEndpoint, $customerData);

    // Check the response and handle errors
    if ($response->successful()) {
        // Customer created successfully
        $customerResponse = $response->json();
        print_r(" success");
        dd($customerResponse);
        return $customerResponse['Id']; // Return the ID of the created customer
    } else {
        // Handle error
        $errorResponse = $response->json();
        // Log or handle the error as needed
        // print_r("not success");
        // dd($errorResponse);
        return null; // Return null or an error indicator
    }
    $apiEndpoint = 'https://quickbooks.api.intuit.com/v3/company/4620816365341697800/invoice';
        // Define the invoice data (replace with your actual invoice data)
        $invoiceData = [
            
            "Line" => [
                [
                    "Amount" => 100.00, // Replace with your invoice amount
                    "DetailType" => "SalesItemLineDetail",
                    "SalesItemLineDetail" => [
                        "ItemRef" => [
                            "value" => 1, // Replace with the item ID from QuickBooks
                        ],
                    ],
                ],
            ],
            // Other invoice data
        ];

        // Send the POST request to create the invoice
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post($apiEndpoint, $invoiceData);

        // Check the response and handle errors
        if ($response->successful()) {
            // Invoice created successfully
            $invoiceResponse = $response->json();
            return $invoiceResponse['Id']; // Return the ID of the created invoice
        } else {
            // Handle error
            $errorResponse = $response->json();
            // Log or handle the error as needed
            return null; // Return null or an error indicator
        }
    
            // $realmID = '4620816365341697800'; // Replace with your QuickBooks realm ID
    // $baseURL = "https://sandbox-quickbooks.api.intuit.com/v3/company/{$realmID}";
    //  $apiEndpoint = "/customer";
     
    // $customerData = [
    //     // Define your customer data in JSON format here
    //     "BillAddr" => [
    //         "Line1" => "123 Main Street",
    //         "City" => "Mountain View",
    //         "Country" => "USA",
    //         "CountrySubDivisionCode" => "CA",
    //         "PostalCode" => "94042"
    //     ],
    //     "Notes" => "Here are other details.",
    //     "Title" => "Mr",
    //     "GivenName" => "Radhe",
    //     "MiddleName" => "B",
    //     "FamilyName" => "KingCRUD",
    //     "Suffix" => "Jr",
    //     "FullyQualifiedName" => "JamesCRUD KingCRUD",
    //     "CompanyName" => "King Groceries CRUD",
    //     "DisplayName" => "JamesCfdRdUDesf KingCRUD",
    //     "PrimaryPhone" => [
    //         "FreeFormNumber" => "(555) 555-5555"
    //     ],
    //     "PrimaryEmailAddr" => [
    //         "Address" => "jdrew@myemail.com"
    //     ]
    // ];

    // // Make the API POST request
    // $response = Http::withHeaders([
    //     'Content-Type' => 'application/json',
    //     'Authorization' => 'Bearer ' . $accessToken,
    // ])->post($baseURL . $apiEndpoint, $customerData);
    
    // // dd($response);

    // // Check the response and handle any errors or process the result as needed
    // if ($response->successful()) {
    //     $result = $response->json();
    //     // Handle success, e.g., extract customer ID
    //     $createdCustomerId = $result['Id'];
    //     return "Customer created with ID: $createdCustomerId";
    // } else {
    //     $error = $response->json();
    //     // Handle error, e.g., log error messages
    //     return "API Error: " . json_encode($error);
    // }
     
        $dataService = DataService::Configure([
            'auth_mode' => 'oauth2',
            'ClientID' => config('quickbooks.ClientID'),
            'ClientSecret' => config('quickbooks.ClientSecret'),
            'accessToken' => $accessToken,
            'QBORealmID' => config('quickbooks.QBORealmID'),
            'baseUrl' => config('quickbooks.none'),
              ]);

          
        // $theResourceObj = Customer::create([
        //     "BillAddr" => [
        //         "Line1" => "123 Main Street",
        //         "City" => "Mountain View",
        //         "Country" => "USA",
        //         "CountrySubDivisionCode" => "CA",
        //         "PostalCode" => "94042"
        //     ],
        //     "Notes" => "Here are other details.",
        //     "Title" => "Mr",
        //     "GivenName" => "Radhe",
        //     "MiddleName" => "B",
        //     "FamilyName" => "KingCRUD",
        //     "Suffix" => "Jr",
        //     "FullyQualifiedName" => "JamesCRUD KingCRUD",
        //     "CompanyName" => "King Groceries CRUD",
        //     "DisplayName" => "JamesCfdRdUDesf KingCRUD",
        //     "PrimaryPhone" => [
        //         "FreeFormNumber" => "(555) 555-5555"
        //     ],
        //     "PrimaryEmailAddr" => [
        //         "Address" => "jdrew@myemail.com"
        //     ]
        //   ]);
 
        //   try {
        //     $resultingObj = $dataService->Add($theResourceObj);
        //     // $createdCustomerId = $resultingObj->Id;
        //      echo "Customer created with ID:";
        // } catch (\Exception $ex) {
        //     echo "Error: " . $ex->getMessage();
        // }
        //   $resultingObj = $dataService->Add($theResourceObj);
        //   $result = json_encode($resultingObj, JSON_PRETTY_PRINT);

        //   print_r($result);

        //   dd($resultingObj);
        //     // Attempt to create a customer
        //     $customer = Customer::create([
        //         "DisplayName" => "Nis",
        //         "GivenName" => "John",
        //         "FamilyName" => "Doe",
               
        //     ]);
        // dd($customer);
        // Create an IPPReferenceType object for the customer
        $customerRef = new IPPReferenceType();
        $customerRef->value = 1;
        //  dd($customer->Id);
        // // Create an invoice
        $invoice = Invoice::create([
            "Line" => [
                [
                    "Amount" => 100.00, // Replace with your invoice amount
                    "DetailType" => "SalesItemLineDetail",
                    "SalesItemLineDetail" => [
                        "ItemRef" => [
                            "value" => 1, // Replace with the item ID from QuickBooks
                        ],
                    ],
                ],
            ],
            "CustomerRef" => $customerRef, // Set the 'CustomerRef' to an IPPReferenceType object
        ]);
        
        // // dd($dataService);
        // try {
        //     // Attempt to add the invoice
            $savedInvoice = $dataService->Add($invoice);
            dd($dataService->Add($invoice));
    
        //     // Check if the operation was successful
        //     if ($savedInvoice) {
        //         return $savedInvoice->Id;
        //     } else {
        //         return "Failed to add the invoice.";
        //     }
        // } catch (\Exception $e) {
        //     // Handle the exception and log the error
        //     \Log::error("Error adding the invoice: " . $e->getMessage());
        //     return "Failed to add the invoice. Check the error log for details.";
        // }
        return $savedInvoice->Id;
    }
    
    private function chargePaymentMethod($accessToken)
    {
        // Initialize the QuickBooks API Data Service with your credentials and access token
        $dataService = DataService::Configure([
            'auth_mode' => 'oauth2',
            'ClientID' => config('quickbooks.ClientID'),
            'ClientSecret' => config('quickbooks.ClientSecret'),
            'accessTokenKey' => $accessToken, // Set the access token
            'QBORealmID' => config('quickbooks.QBORealmID'),
            'baseUrl' => config('quickbooks.none'),
        ]);

        // Create a payment receipt
        $paymentReceipt = Payment::create([
            "CustomerRef" => [
                "value" => 1, // Replace with the customer ID from QuickBooks
            ],
            "TotalAmt" => 100.00, // Replace with the payment amount
            "UnappliedAmt" => 0,
        ]);

       
            // $savedPaymentReceipt = $dataService->Add($paymentReceipt);

            try {
                // Attempt to add the invoice
                $savedPaymentReceipt = $dataService->Add($paymentReceipt);
        
                // Check if the operation was successful
                if ($savedPaymentReceipt) {
                    return $savedPaymentReceipt->Id;
                } else {
                    return "Failed to add the payment.";
                }
            } catch (\Exception $e) {
                // Handle the exception and log the error
                \Log::error("Error adding the invoice: " . $e->getMessage());
                return "Failed to add the Payment. Check the error log for details.";
            }

          
    }
    public function addBankAccount(Request $request)
{
    // Initialize the QuickBooks API Data Service with your credentials and access token
    $dataService = DataService::Configure([
        'auth_mode' => 'oauth2',
        'ClientID' => config('quickbooks.ClientID'),
        'ClientSecret' => config('quickbooks.ClientSecret'),
        'accessToken' => $accessToken, // Make sure you have the access token
        'QBORealmID' => config('quickbooks.QBORealmID'),
        'baseUrl' => config('quickbooks.none'),
    ]);

    // Define the bank account details
    $bankAccountDetails = [
        "Name" => "My Bank Account", // Replace with your preferred name
        "AccountType" => "Bank",
        "AccountNumber" => "123456789", // Replace with your actual account number
        "RoutingNumber" => "987654321", // Replace with your actual routing number
        "CurrencyRef" => [
            "value" => "USD", // Replace with your desired currency
        ],
    ];

    // Create the bank account
    $bankAccount = Customer::create($bankAccountDetails);

    // Save the bank account
    $savedBankAccount = $dataService->Add($bankAccount);

    return "Bank account added successfully. Account ID: " . $savedBankAccount->Id;
}

    }