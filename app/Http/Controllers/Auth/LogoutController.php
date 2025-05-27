<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Session;


class LogoutController extends Controller
{
  
public function logout(Request $request)
{
    // Clear all sessions
    Session::flush();
dd("hiii");
    // Perform other logout actions if needed

    return redirect('/login'); // Redirect the user to the sign-in page after logout
}
}