<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\Create;
use App\Http\Requests\Booking\Update;
use App\Service\BookingService;
use Illuminate\Http\Request;
use App\Http\Resources\Booking\resource as BookingResource;
use App\Http\Resources\Booking\collection as BookingCollection;
use App\Models\Booking;

class BookingController extends Controller
{
    private $service;

    public function __construct(BookingService $bookingService)
    {
        $this->service = $bookingService;
    }

    public function index(Request $request)
    {
        $collections = Booking::paginate(5);

        // if (isset($request->search)) {
        //     $bookings->Where('booking_type', 'like', '%' . $request->search . '%')
        //         ->orWhere('booking_sloat', 'like', '%' . $request->search . '%');
        // }

        // if (isset($request->start_date)) {
        //     $bookings->whereBetween('booking_date', [$request->start_date, $request->end_date]);
        // }

        // if ($request->limit > 0) {
        //     $collection = $bookings->paginate($request->limit);
        // } else {
        //     $collection = $bookings->get();
        // }

        return view('index', compact('collections'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Create $request)
    {
        $userBooking = Booking::where('email', $request->email)->where('booking_type', $request->booking_type)->where('booking_date', $request->booking_date)->first();
        $bookingType = Booking::where('booking_type', $request->booking_type)->where('booking_date', $request->booking_date)->first();


        if ($userBooking != null || $bookingType != null) {
            return redirect()->back()->with('message', "another user have already booked today's sloat, please try diffrent sloat");
        }

        if ($request->booking_type == 'full_day' && $request->booking_sloat != 'fullday') {
            return redirect()->back()->with('message', 'Please enter valid sloat name (like fullday)');
        }
        if ($request->booking_type == 'half_day' && $request->booking_sloat == 'fullday') {
            return redirect()->back()->with('message', 'Please enter valid sloat name (like morning, evening)');
        }

        $bookingService = Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'booking_type' => $request->booking_type,
            'booking_date' => $request->booking_date,
            'booking_sloat' => $request->booking_sloat,
            'booking_time' => $request->booking_time,
        ]);

        if ($bookingService) {
            return redirect()->route('bookings.index')->with('message', 'your booking is sucessfully');
        }
    }

    public function show($id)
    {
        $data = $this->service->resource($id);
        return new BookingResource($data);
    }

    public function edit($id)
    {
        $booking = Booking::FindOrFail($id);
        return view('edit', compact('booking'));
    }

    public function update(Update $request, $id)
    {
        $bookingObj = Booking::FindOrFail($id);

        $userBooking = Booking::where('email', $request->email)->where('booking_type', $request->booking_type)->where('booking_date', $request->booking_date)->first();
        $bookingType = Booking::where('booking_type', $request->booking_type)->where('booking_date', $request->booking_date)->first();

        if ($userBooking != null || $bookingType != null) {
            return redirect()->back()->with('message', "another user have already booked today's sloat, please try diffrent sloat");
        }

        if ($request->booking_type == 'full_day' && $request->booking_sloat != 'fullday') {
            return redirect()->back()->with('message', 'Please enter valid sloat name (like fullday)');
        }

        if ($request->booking_type == 'half_day' && $request->booking_sloat == 'fullday') {
            return redirect()->back()->with('message', 'Please enter valid sloat name (like morning, evening)');
        }

        $updateBookingData = $bookingObj->update([
            'booking_type' => $request->booking_type,
            'booking_date' => $request->booking_date,
            'booking_sloat' => $request->booking_sloat,
            'booking_time' => $request->booking_time,
        ]);

        if ($updateBookingData) {
            return redirect()->route('bookings.index')->with('message', 'your booking is updated sucessfully');
        }
    }

    public function destroy($id)
    {
        $bookingObj = Booking::FindOrFail($id);
        if ($bookingObj->delete()) {
            return redirect()->route('bookings.index')->with('message', 'your booking is deleted sucessfully');
        }
    }
}
