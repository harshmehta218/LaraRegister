<!DOCTYPE html>
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
        <h2>form</h2>
        @if (Session::has('message'))
            <div class="alert alert-warning">
                <p class="alert">{!! Session::get('message') !!}</p>
            </div>
        @endif
        <form action="{{ route('booking.update', $booking->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Name:</label>
                <input type="name" class="form-control" id="name" placeholder="Enter name" name="name"
                    @if ($booking->name) value="{{ $booking->name }}" @endif>
                @if ($errors->has('name'))
                    <span class="invalid feedback" style='color: red' role="alert">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                    @if ($booking->email) value="{{ $booking->email }}" @endif>
                @if ($errors->has('email'))
                    <span class="invalid feedback" style='color: red'
                        role="alert">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Booking Type:</label>
                <select name="booking_type" class="form-control" id="booking_type">
                    <option value=" ">Select</option>
                    <option value="full_day" @if ($booking->booking_type == 'full_day') selected="selected" @endif>Full Day
                    </option>
                    <option value="half_day" @if ($booking->booking_type == 'half_day') selected="selected" @endif>Half Day
                    </option>
                </select>
                @if ($errors->has('booking_type'))
                    <span class="invalid feedback" style='color: red'
                        role="alert">{{ $errors->first('booking_type') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="booking_date">Booking Date</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date">
                @if ($errors->has('booking_date'))
                    <span class="invalid feedback" style='color: red'
                        role="alert">{{ $errors->first('booking_date') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="booking_sloat">Booking Sloat</label>
                <select name="booking_sloat" class="form-control" id="booking_sloat">
                    <option value=" ">Select</option>
                    <option value="morning" @if ($booking->booking_sloat == 'morning') selected="selected" @endif>Morning
                    </option>
                    <option value="evening" @if ($booking->booking_sloat == 'evening') selected="selected" @endif>Evening
                    </option>
                    <option value="fullday" @if ($booking->booking_sloat == 'fullday') selected="selected" @endif>Fullday
                    </option>
                </select>
                @if ($errors->has('booking_sloat'))
                    <span class="invalid feedback" style='color: red'
                        role="alert">{{ $errors->first('booking_sloat') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="booking_time">Booking Time</label>
                <input type="time" class="form-control" id="booking_time" name="booking_time">
                @if ($errors->has('booking_time'))
                    <span class="invalid feedback" style='color: red'
                        role="alert">{{ $errors->first('booking_time') }}</span>
                @endif
            </div><br><br>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>

</html>
