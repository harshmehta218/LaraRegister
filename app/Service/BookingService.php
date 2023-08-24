<?php

namespace App\Service;

use App\Models\Booking;

class BookingService
{
    private $model;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    public function collection($requestArray)
    {
        $bookings = Booking::with('user');

        if (isset($requestArray['search'])) {
            $bookings->Where('booking_type', 'like', '%' . $requestArray['search'] . '%')
                ->orWhere('booking_sloat', 'like', '%' . $requestArray['search'] . '%');
        }

        if (isset($requestArray['start_date'])) {
            $bookings->whereBetween('booking_date', [$requestArray['start_date'], $requestArray['end_date']]);
        }

        if ($requestArray['limit'] > 0) {
            $collection = $bookings->paginate($requestArray['limit']);
        } else {
            $collection = $bookings->get();
        }

        return $collection;
    }

    public function resource($id)
    {
        $booking = Booking::with('user')->FindOrFail($id);
        return $booking;
    }

    public function store($requestArray)
    {
        $userBooking = Booking::where('user_id', $requestArray['user_id'])->where('booking_type', $requestArray['booking_type'])->where('booking_date', $requestArray['booking_date'])->first();
        $bookingType = Booking::where('booking_type', $requestArray['booking_type'])->where('booking_date', $requestArray['booking_date'])->first();

        if ($userBooking != null || $bookingType != null) {
            $message['booking']['faild']['message'] = "another user have already booked today's sloat, please try diffrent sloat";
            return $message;
        }

        if ($requestArray['booking_type'] == 'full_day' && $requestArray['booking_sloat'] != 'fullday') {
            $message['booking']['wrongSloat']['message'] = "Please enter valid sloat name (like fullday)";
            return $message;
        }

        if ($requestArray['booking_type'] == 'half_day' && $requestArray['booking_sloat'] == 'fullday') {
            $message['booking']['wrongSloat']['message'] = "Please enter valid sloat name (like morning, evening)";
            return $message;
        }

        $bookingService = Booking::create([
            'user_id' => $requestArray['user_id'],
            'booking_type' => $requestArray['booking_type'],
            'booking_date' => $requestArray['booking_date'],
            'booking_sloat' => $requestArray['booking_sloat'],
            'booking_time' => $requestArray['booking_time'],
        ]);

        $bookingObjectWithUser = $this->resource($bookingService->id);
        return $bookingObjectWithUser;
    }

    public function update($requestArray, $id)
    {
        $bookingObj = $this->resource($id);

        if ($requestArray['booking_type'] == 'full_day' && $requestArray['booking_sloat'] != 'fullday') {
            $message['booking']['wrongSloat']['message'] = "Please enter valid sloat name (like fullday)";
            return $message;
        }

        if ($requestArray['booking_type'] == 'half_day' && $requestArray['booking_sloat'] == 'fullday') {
            $message['booking']['wrongSloat']['message'] = "Please enter valid sloat name (like morning, evening)";
            return $message;
        }

        $updateBookingData = $bookingObj->update([
            'booking_type' => $requestArray['booking_type'],
            'booking_date' => $requestArray['booking_date'],
            'booking_sloat' => $requestArray['booking_sloat'],
            'booking_time' => $requestArray['booking_time'],
        ]);

        if ($updateBookingData) {
            $updateBookingObject = $this->resource($id);
            return $updateBookingObject;
        }
    }

    public function destroy($id)
    {
        $bookingObj = $this->resource($id);
        if ($bookingObj->delete()) {
            $message['booking']['deleted']['sucess'] = "your booking is deleted sucessfully";
            return $message;
        }
    }
}
