<?php

namespace App\Exports;

use App\Models\EmailAuditLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmailLogsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return EmailAuditLog::with('user')->get()->map(function ($log) {
            return [
                'From' => $log->from,
                'To' => $log->to,
                'Subject' => $log->subject,
                'URL' => $log->url,
                'User' => $log->user->name ?? 'N/A',
                'Sent At' => $log->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return ['From', 'To', 'Subject', 'URL', 'User', 'Sent At'];
    }
}
