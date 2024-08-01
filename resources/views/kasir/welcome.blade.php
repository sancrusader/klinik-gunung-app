<!-- resources/views/kasir/dashboard.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Kasir Dashboard</title>
</head>

<body>
    <h1>Kasir Dashboard</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @elseif (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Mountain</th>
                <th>Citizenship</th>
                <th>Country</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Queue Number</th>
                <th>Certificate Path</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screenings as $screening)
                <tr>
                    <td>{{ $screening->full_name }}</td>
                    <td>{{ $screening->date_of_birth }}</td>
                    <td>{{ $screening->mountain }}</td>
                    <td>{{ $screening->citizenship }}</td>
                    <td>{{ $screening->country }}</td>
                    <td>{{ $screening->address }}</td>
                    <td>{{ $screening->phone }}</td>
                    <td>{{ $screening->email }}</td>
                    <td>{{ $screening->queue_number }}</td>
                    <td>
                        @if ($screening->certificate_path)
                            <a href="{{ asset('storage/' . $screening->certificate_path) }}" target="_blank">View
                                Certificate</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('kasir.issue_certificate', $screening->id) }}" method="POST">
                            @csrf
                            <button type="submit">Issue Certificate</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $screenings->links() }} <!-- Pagination links -->
</body>

</html>
