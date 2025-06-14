<table border="1" cellspacing="0" cellpadding="5">
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
        @foreach($data as $log)
            <tr>
                <td>{{ $log->from }}</td>
                <td>{{ $log->to }}</td>
                <td>{{ $log->subject }}</td>
                <td>{{ $log->url }}</td>
                <td>{{ $log->user->name ?? 'N/A' }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
