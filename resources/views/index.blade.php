<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <a href="{{ route('bookings.create') }}">Create Booking</a>
        <h2>Booking Table</h2>
        @if (Session::has('message'))
            <div class="alert alert-warning">
                <p class="alert">{!! Session::get('message') !!}</p>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Booking Type</th>
                    <th>Booking Sloat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($collections)
                    @foreach ($collections as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->booking_type }}</td>
                            <td>{{ $item->booking_sloat }}</td>
                            <td>
                                <a href="{{ route('booking.edit', $item->id) }}">Edit</a>
                                <form action="{{ route('booking.delete', $item->id) }}" method="post">
                                    @csrf
                                    <button>Delete Booking</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    {!! $collections->links() !!}
</body>

</html>
