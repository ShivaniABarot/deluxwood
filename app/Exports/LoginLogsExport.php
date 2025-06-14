<?php

namespace App\Exports;

use App\Models\LoginLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoginLogsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return LoginLog::with('user')->get()->map(function ($log) {
            return [
                'User' => $log->user->name ?? 'N/A',
                'IP Address' => $log->ip_address,
                'User Agent' => $log->user_agent,
                'Logged In At' => $log->logged_in_at,
            ];
        });
    }

    public function headings(): array
    {
        return ['User', 'IP Address', 'User Agent', 'Logged In At'];
    }
}
