@extends(backendView('layouts.app'))

@section('title', 'System Logs')

@section('content')
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                    class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">System Logs</h3>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary me-2" id="showLoginLogs">Login Logs</button>
            <button class="btn btn-secondary" id="showEmailLogs">Email Logs</button>
        </div>

        {{-- Flash Messages --}}
        <div class="flash-message-container">
            @if(session('success'))
                <div class="flash-message">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="flash-message-error">{{ session('error') }}</div>
            @endif
        </div>

        {{-- Login Logs --}}
        <div class="row g-3 mb-3 log-section" id="loginLogsSection">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong>Login Logs</strong>
                        <div>
                            <a href="{{ route('logs.login.excel') }}" class="btn btn-success btn-sm">
                                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                            </a>
                            <a href="{{ route('logs.login.pdf') }}" class="btn btn-danger btn-sm">
                                <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                            </a>

                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="loginLogsTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>Logged In At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loginLogs as $log)
                                    <tr>
                                        <td>{{ $log->user->name ?? 'N/A' }}</td>
                                        <td>{{ $log->ip_address }}</td>
                                        <td>{{ $log->user_agent }}</td>
                                        <td>{{ $log->logged_in_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No login logs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Email Audit Logs --}}
        <div class="row g-3 mb-3 log-section d-none" id="emailLogsSection">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong>Email Audit Logs</strong>
                        <div>
                            <a href="{{ route('logs.email.excel') }}" class="btn btn-success btn-sm">
                                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                            </a>
                            <a href="{{ route('logs.email.pdf') }}" class="btn btn-danger btn-sm">
                                <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                            </a>

                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="emailLogsTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Subject</th>
                                    <th>URL</th>
                                    <th>User</th>
                                    <th>Sent At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($emailLogs as $log)
                                    <tr>
                                        <td>{{ $log->from }}</td>
                                        <td>{{ $log->to }}</td>
                                        <td>{{ $log->subject }}</td>
                                        <td>
                                            @if($log->url)
                                                <a href="{{ $log->url }}" target="_blank">View</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $log->user->name ?? 'N/A' }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No email logs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
    <link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush

@push('scripts')
    <script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

@endpush

@push('custom_scripts')
    <script>
        $(document).ready(function () {
            $('#loginLogsTable, #emailLogsTable').addClass('nowrap').dataTable({
                responsive: true,
                order: [[0, 'desc']]
            });

            $('#showLoginLogs').click(function () {
                $('#loginLogsSection').removeClass('d-none');
                $('#emailLogsSection').addClass('d-none');
                $(this).removeClass('btn-secondary').addClass('btn-primary');
                $('#showEmailLogs').removeClass('btn-primary').addClass('btn-secondary');
            });

            $('#showEmailLogs').click(function () {
                $('#emailLogsSection').removeClass('d-none');
                $('#loginLogsSection').addClass('d-none');
                $(this).removeClass('btn-secondary').addClass('btn-primary');
                $('#showLoginLogs').removeClass('btn-primary').addClass('btn-secondary');
            });
        });
    </script>
@endpush