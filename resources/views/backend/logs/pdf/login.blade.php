<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>User</th>
            <th>IP Address</th>
            <th>User Agent</th>
            <th>Logged In At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $log)
            <tr>
                <td>{{ $log->user->name ?? 'N/A' }}</td>
                <td>{{ $log->ip_address }}</td>
                <td>{{ $log->user_agent }}</td>
                <td>{{ $log->logged_in_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
