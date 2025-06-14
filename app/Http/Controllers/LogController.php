<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\EmailAuditLog;
use Illuminate\Http\Request;
use App\Exports\LoginLogsExport;
use App\Exports\EmailLogsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class LogController extends Controller
{
    public function index()
{
    $loginLogs = LoginLog::with('user')->latest()->get();
    $emailLogs = EmailAuditLog::with('user')->latest()->get();
    // dd($emailLogs);
    return view('backend.logs.index', [
        'loginLogs' => $loginLogs,
        'emailLogs' => $emailLogs,
        'pagename' => 'Logs Index'
    ]);
}

public function exportLoginLogsExcel()
{
    return Excel::download(new LoginLogsExport, 'login_logs.xlsx');
}

public function exportEmailLogsExcel()
{
    return Excel::download(new EmailLogsExport, 'email_logs.xlsx');
}

public function exportLoginLogsPDF()
{
    $data = LoginLog::with('user')->get();
    $pdf = PDF::loadView('backend.logs.pdf.login', compact('data'));
    return $pdf->download('login_logs.pdf');
}

public function exportEmailLogsPDF()
{
    $data = EmailAuditLog::with('user')->get();
    $pdf = PDF::loadView('backend.logs.pdf.email', compact('data'));
    return $pdf->download('email_logs.pdf');
}


}
